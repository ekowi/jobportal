<?php

namespace App\Livewire\Cbt;

use Livewire\Component;
use App\Models\Soal;
use App\Models\TestResult;
use App\Models\TestAnswer;
use Illuminate\Support\Facades\Auth;

class Test extends Component
{
    public $currentQuestion = 0;
    public $questions;
    public $userAnswers = [];
    public $markedQuestions = [];
    public $testStarted = false;
    public $testCompleted = false;
    public $timeLeft;
    public $testResult;
    public $showConfirmModal = false;
    
    // public $totalQuestions = 10; 
    public $testDuration = 30; // in minutes

    protected $listeners = ['timeUp' => 'completeTest'];

    public function mount()
    {
        // Ambil SEMUA soal yang aktif secara acak
        $this->questions = Soal::where('status', true)
            ->inRandomOrder()
            // Hapus ->take() untuk mengambil semua soal
            ->get();
            
        // Inisialisasi array jawaban berdasarkan jumlah soal yang diambil
        $this->userAnswers = array_fill(0, $this->questions->count(), null);
        
        $this->timeLeft = $this->testDuration * 60; // Convert to seconds
        $this->markedQuestions = [];
    }

    public function startTest()
    {
        $this->testStarted = true;
        $this->testResult = TestResult::create([
            'user_id' => Auth::id(),
            'total_questions' => $this->questions->count(),
            'started_at' => now(),
        ]);
    }

    public function nextQuestion()
    {
        if ($this->currentQuestion < $this->questions->count() - 1) {
            $this->currentQuestion++;
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    public function goToQuestion($index)
    {
        if ($index >= 0 && $index < $this->questions->count()) {
            $this->currentQuestion = $index;
        }
    }

    public function toggleMarkQuestion()
    {
        if (in_array($this->currentQuestion, $this->markedQuestions)) {
            $this->markedQuestions = array_diff($this->markedQuestions, [$this->currentQuestion]);
        } else {
            $this->markedQuestions[] = $this->currentQuestion;
        }
    }

    public function isQuestionAnswered($index)
    {
        return isset($this->userAnswers[$index]) && $this->userAnswers[$index] !== null;
    }

    public function isQuestionMarked($index)
    {
        return in_array($index, $this->markedQuestions);
    }

    public function getAnsweredCount()
    {
        return count(array_filter($this->userAnswers, function($answer) {
            return $answer !== null;
        }));
    }

    public function getUnansweredCount()
    {
        return $this->questions->count() - $this->getAnsweredCount();
    }

    public function getMarkedCount()
    {
        return count($this->markedQuestions);
    }

    public function showConfirmation()
    {
        $this->showConfirmModal = true;
    }

    public function hideConfirmation()
    {
        $this->showConfirmModal = false;
    }

    public function completeTest()
    {
        if (!$this->testResult) {
            return;
        }

        $correctAnswers = 0;
        
        foreach ($this->questions as $index => $question) {
            $userAnswer = $this->userAnswers[$index] ?? null;
            $isCorrect = $userAnswer == $question->jawaban;
            
            if ($isCorrect) {
                $correctAnswers++;
            }

            TestAnswer::create([
                'test_result_id' => $this->testResult->id,
                'soal_id' => $question->id_soal,
                'user_answer' => (string)$userAnswer,
                'is_correct' => $isCorrect
            ]);
        }

        $score = ($this->questions->count() > 0) ? ($correctAnswers / $this->questions->count()) * 100 : 0;

        $this->testResult->update([
            'correct_answers' => $correctAnswers,
            'score' => $score,
            'completed_at' => now()
        ]);

        $this->testCompleted = true;
        $this->showConfirmModal = false;
    }

    public function render()
    {
        // Perbarui totalQuestions di view agar dinamis
        return view('livewire.cbt.test', [
            'totalQuestions' => $this->questions->count()
        ]);
    }

     public function selectAnswer($option)
    {
        $this->userAnswers[$this->currentQuestion] = $option;
    }
}
