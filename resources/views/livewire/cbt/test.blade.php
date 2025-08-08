<div class="min-vh-100 bg-white">
    <section class="section">
    @if(!$testStarted)
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h2 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Computer Based Test</h2>
                        </div>
                        <div class="card-body p-5">
                            <div class="alert alert-info border-0 shadow-sm mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-info-circle fs-4 me-3 text-info"></i>
                                    <h5 class="mb-0">Petunjuk Pengerjaan</h5>
                                </div>
                                <ul class="mb-0 ps-3">
                                    <li class="mb-2">Anda akan mengerjakan <strong>{{ min($totalQuestions, $maxQuestions) }} soal</strong></li>
                                    <li class="mb-2">Waktu pengerjaan: <strong>{{ $testDuration }} menit</strong></li>
                                    <li class="mb-2">Soal ditampilkan secara acak</li>
                                    <li class="mb-2">Pastikan koneksi internet Anda stabil selama tes berlangsung</li>
                                    <li class="mb-2">Jangan merefresh atau menutup halaman browser</li>
                                    <li class="mb-2">Gunakan tombol navigasi untuk berpindah antar soal</li>
                                    <li class="mb-0">Anda dapat menandai soal untuk ditinjau kembali</li>
                                </ul>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <i class="fas fa-clock text-primary fs-2 mb-2"></i>
                                        <h6 class="text-muted mb-0">Waktu</h6>
                                        <div class="fw-bold">{{ $testDuration }} Menit</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <i class="fas fa-question-circle text-success fs-2 mb-2"></i>
                                        <h6 class="text-muted mb-0">Jumlah Soal</h6>
                                        <div class="fw-bold">{{ min($totalQuestions, $maxQuestions) }} Soal</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <i class="fas fa-random text-info fs-2 mb-2"></i>
                                        <h6 class="text-muted mb-0">Soal Acak</h6>
                                        <div class="fw-bold">Ya</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded-3">
                                        <i class="fas fa-award text-warning fs-2 mb-2"></i>
                                        <h6 class="text-muted mb-0">Passing Grade</h6>
                                        <div class="fw-bold">70%</div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button wire:click="startTest" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                                    <i class="fas fa-play me-2"></i>Mulai Tes Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif($testCompleted)
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-success text-white text-center py-4">
                            <h3 class="mb-0"><i class="fas fa-check-circle me-2"></i>Tes Selesai</h3>
                            <p class="mb-0 mt-2 fs-5"><strong>{{ $testResult->user->name }}</strong></p>
                        </div>
                        <div class="card-body p-5">
                            <div class="row g-4 mb-5">
                                <div class="col-md-3">
                                    <div class="text-center p-4 bg-primary text-white rounded-3">
                                        <i class="fas fa-percentage fs-1 mb-3"></i>
                                        <h4 class="mb-0">{{ number_format($testResult->score, 1) }}%</h4>
                                        <small>Skor Anda</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-4 bg-success text-white rounded-3">
                                        <i class="fas fa-check fs-1 mb-3"></i>
                                        <h4 class="mb-0">{{ $testResult->correct_answers }}</h4>
                                        <small>Jawaban Benar</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-4 bg-danger text-white rounded-3">
                                        <i class="fas fa-times fs-1 mb-3"></i>
                                        <h4 class="mb-0">{{ min($totalQuestions, $maxQuestions) - $testResult->correct_answers }}</h4>
                                        <small>Jawaban Salah</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-4 bg-info text-white rounded-3">
                                        <i class="fas fa-random fs-1 mb-3"></i>
                                        <h4 class="mb-0">{{ min($totalQuestions, $maxQuestions) }}</h4>
                                        <small>Total Soal</small>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                @if($testResult->score >= 70)
                                    <span class="badge bg-success fs-5 px-4 py-2 rounded-pill">
                                        <i class="fas fa-trophy me-2"></i>LULUS
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-5 px-4 py-2 rounded-pill">
                                        <i class="fas fa-exclamation-triangle me-2"></i>TIDAK LULUS
                                    </span>
                                @endif
                            </div>

                            <div class="mt-5">
                                <h5 class="mb-4"><i class="fas fa-clipboard-list me-2"></i>Review Jawaban</h5>
                                <div class="accordion" id="answerAccordion">
                                    @foreach($questions as $index => $question)
                                        @php
                                            $isCorrect = isset($userAnswers[$index]) && $userAnswers[$index] == $question->jawaban;
                                            $userAnswer = $userAnswers[$index] ?? null;
                                        @endphp
                                        <div class="accordion-item border-0 shadow-sm mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed d-flex align-items-center {{ $isCorrect ? 'bg-success-subtle' : 'bg-danger-subtle' }}" 
                                                        type="button" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#question{{ $index + 1 }}"
                                                        aria-expanded="false">
                                                    <div class="d-flex align-items-center w-100">
                                                        <span class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }} me-3">
                                                            <i class="fas {{ $isCorrect ? 'fa-check' : 'fa-times' }}"></i>
                                                        </span>
                                                        <span class="fw-bold">Soal {{ $index + 1 }}</span>
                                                        <span class="ms-auto badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $isCorrect ? 'Benar' : 'Salah' }}
                                                        </span>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="question{{ $index + 1 }}" 
                                                 class="accordion-collapse collapse" 
                                                 data-bs-parent="#answerAccordion">
                                                <div class="accordion-body">
                                                    <div class="mb-4">
                                                        <h6 class="text-muted mb-2">Pertanyaan:</h6>
                                                        @if($question->type_soal_id == 2)
                                                            <img src="{{ Storage::url($question->soal) }}" 
                                                                 class="img-fluid rounded shadow-sm question-image" 
                                                                 alt="Question Image"
                                                                 style="max-height: 200px">
                                                        @else
                                                            <p class="fs-6">{{ $question->soal }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <h6 class="text-muted mb-2">Jawaban Anda:</h6>
                                                        @if($userAnswer)
                                                            @if($question->type_jawaban_id == 2)
                                                                <img src="{{ Storage::url($question->{'pilihan_' . $userAnswer}) }}" 
                                                                     class="img-fluid rounded shadow-sm answer-image mb-2" 
                                                                     alt="Your Answer"
                                                                     style="max-height: 100px">
                                                            @else
                                                                <div class="p-3 rounded {{ $isCorrect ? 'bg-success-subtle border-success' : 'bg-danger-subtle border-danger' }} border">
                                                                    {{ $question->{'pilihan_' . $userAnswer} }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="p-3 rounded bg-warning-subtle border-warning border">
                                                                <i class="fas fa-exclamation-triangle me-2"></i>Tidak dijawab
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if(!$isCorrect)
                                                        <div class="mb-3">
                                                            <h6 class="text-muted mb-2">Jawaban Benar:</h6>
                                                            @if($question->type_jawaban === 'foto')
                                                                <img src="{{ Storage::url($question->{'pilihan_' . $question->jawaban}) }}" 
                                                                     class="img-fluid rounded shadow-sm" 
                                                                     style="max-height: 100px">
                                                            @else
                                                                <div class="p-3 rounded bg-success-subtle border-success border">
                                                                    {{ $question->{'pilihan_' . $question->jawaban} }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">
                                    <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="container-fluid py-3">
            <div class="row g-3">
                <div class="col-lg-3">
                    <div class="sticky-top" style="top: 1rem;">
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-header bg-gradient text-white text-center py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <h5 class="mb-2" style="text-transform: uppercase; color: #3c4858;"><i class="fas fa-clock me-2"></i>Waktu Tersisa</h5>
                                <div x-data="timer()" x-init="startTimer()">
                                    {{-- The text-dark class is removed from here --}}
                                    <div class="timer-display bg-white rounded-3 p-3 shadow-sm">
                                        {{-- The :class directive is added here to dynamically change color --}}
                                        <span x-text="formatTime()" 
                                              class="fs-3 fw-bold font-monospace"
                                              :class="{'text-danger': timeLeft < 300, 'text-dark': timeLeft >= 300}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Progress</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 text-center">
                                    <div class="col-4">
                                        <div class="p-2 bg-success-subtle rounded">
                                            <div class="fw-bold text-success">{{ $this->getAnsweredCount() }}</div>
                                            <small class="text-muted">Dijawab</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-2 bg-warning-subtle rounded">
                                            <div class="fw-bold text-warning">{{ $this->getMarkedCount() }}</div>
                                            <small class="text-muted">Ditandai</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-2 bg-danger-subtle rounded">
                                            <div class="fw-bold text-danger">{{ $this->getUnansweredCount() }}</div>
                                            <small class="text-muted">Kosong</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-3" style="height: 8px;">
                                    <div class="progress-bar bg-success" 
                                         style="width: {{ ($this->getAnsweredCount() / count($questions)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-list me-2"></i>Navigasi Soal</h6>
                            </div>
                            <div class="card-body">
                                <div class="question-grid mb-3">
                                    @foreach($questions as $index => $question)
                                        <button wire:click="goToQuestion({{ $index }})"
                                                class="btn question-btn {{ $currentQuestion === $index ? 'btn-primary' : 
                                                    ($this->isQuestionMarked($index) ? 'btn-warning' : 
                                                    ($this->isQuestionAnswered($index) ? 'btn-success' : 'btn-outline-secondary')) }}"
                                                title="Soal {{ $index + 1 }}{{ $this->isQuestionAnswered($index) ? ' (Dijawab)' : '' }}{{ $this->isQuestionMarked($index) ? ' (Ditandai)' : '' }}">
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button class="btn {{ $this->isQuestionMarked($currentQuestion) ? 'btn-warning' : 'btn-outline-warning' }}" 
                                            wire:click="toggleMarkQuestion">
                                        @if($this->isQuestionMarked($currentQuestion))
                                            <i class="fas fa-bookmark me-1"></i>Hapus Tanda
                                        @else
                                            <i class="far fa-bookmark me-1"></i>Tandai Soal
                                        @endif
                                    </button>
                                    
                                    @if($currentQuestion === count($questions) - 1)
                                        <button class="btn btn-success" wire:click="showConfirmation">
                                            <i class="fas fa-check me-1"></i>Selesai
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-question-circle me-2"></i>
                                Soal {{ $currentQuestion + 1 }} dari {{ count($questions) }}
                            </h5>
                            <div class="badge bg-light text-dark">
                                {{ $this->isQuestionAnswered($currentQuestion) ? 'Dijawab' : 'Belum Dijawab' }}
                            </div>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="question-container mb-4">
                                @if($questions[$currentQuestion]->type_soal_id == 2)
                                    <div class="text-center mb-4">
                                        <img src="{{ Storage::url($questions[$currentQuestion]->soal) }}" 
                                             class="img-fluid rounded shadow-sm question-image" 
                                             alt="Question Image"
                                             style="max-height: 400px">
                                    </div>
                                @else
                                    <div class="question-text p-4 bg-light rounded-3 border-start border-primary border-4">
                                        <p class="fs-5 mb-0 lh-base">{{ $questions[$currentQuestion]->soal }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="answers">
                                @foreach(['pilihan_1', 'pilihan_2', 'pilihan_3', 'pilihan_4'] as $index => $pilihan)
                                    @php
                                        $optionValue = $index + 1;
                                    @endphp
                                    <div class="answer-option mb-3 {{ ($userAnswers[$currentQuestion] ?? null) == $optionValue ? 'selected' : '' }}"
                                         wire:click="selectAnswer({{ $optionValue }})">
                                        
                                        <input type="radio" 
                                            id="q{{ $currentQuestion }}_opt{{ $optionValue }}"
                                            name="answer_for_q_{{ $currentQuestion }}" 
                                            value="{{ $optionValue }}"
                                            wire:model.live="userAnswers.{{ $currentQuestion }}"
                                            class="form-check-input d-none">

                                        <label class="answer-label w-100 p-3 rounded-3 border cursor-pointer d-flex align-items-center" 
                                            for="q{{ $currentQuestion }}_opt{{ $optionValue }}">
                                            <div class="answer-indicator me-3">
                                                <span class="option-letter">{{ chr(65 + $index) }}</span>
                                            </div>
                                            <div class="answer-content flex-grow-1">
                                                @if($questions[$currentQuestion]->type_jawaban_id == 2)
                                                    <img src="{{ Storage::url($questions[$currentQuestion]->$pilihan) }}" 
                                                        class="img-fluid rounded answer-image" 
                                                        alt="Answer Option {{ $optionValue }}"
                                                        style="max-height: 120px">
                                                @else
                                                    <span class="fs-6">{{ $questions[$currentQuestion]->$pilihan }}</span>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer bg-light d-flex justify-content-between align-items-center py-3">
                            <button class="btn btn-outline-secondary" 
                                    wire:click="previousQuestion"
                                    @if($currentQuestion === 0) disabled @endif>
                                <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                            </button>
                            
                            <div class="text-muted">
                                {{ $currentQuestion + 1 }} / {{ count($questions) }}
                            </div>
                            
                            @if($currentQuestion < count($questions) - 1)
                                <button class="btn btn-primary" wire:click="nextQuestion">
                                    Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                                </button>
                            @else
                                <button class="btn btn-success" wire:click="showConfirmation">
                                    <i class="fas fa-check me-1"></i>Selesai
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showConfirmModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Selesai</h5>
                    </div>
                    <div class="modal-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-question-circle text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <p class="text-center fs-5 mb-4">Apakah Anda yakin ingin menyelesaikan tes?</p>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-4 text-center">
                                <div class="p-3 bg-success-subtle rounded">
                                    <div class="fw-bold text-success fs-4">{{ $this->getAnsweredCount() }}</div>
                                    <small class="text-muted">Dijawab</small>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="p-3 bg-warning-subtle rounded">
                                    <div class="fw-bold text-warning fs-4">{{ $this->getMarkedCount() }}</div>
                                    <small class="text-muted">Ditandai</small>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="p-3 bg-danger-subtle rounded">
                                    <div class="fw-bold text-danger fs-4">{{ $this->getUnansweredCount() }}</div>
                                    <small class="text-muted">Belum Dijawab</small>
                                </div>
                            </div>
                        </div>
                        
                        @if($this->getUnansweredCount() > 0)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Masih ada {{ $this->getUnansweredCount() }} soal yang belum dijawab.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="hideConfirmation">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="button" class="btn btn-success" wire:click="completeTest">
                            <i class="fas fa-check me-1"></i>Ya, Selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </section>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .question-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* Konsisten 5 kolom */
            gap: 8px;
            margin-bottom: 1rem;
        }
        .question-btn {
            aspect-ratio: 1; /* Membuat tombol persegi */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            min-height: 40px; /* Tinggi minimum konsisten */
            padding: 0; /* Hilangkan padding default Bootstrap */
            border: 2px solid;
        }

        .question-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .answer-option {
            transition: all 0.3s ease;
        }

        .answer-option:hover .answer-label {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .answer-option.selected .answer-label {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
            transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        }

        .answer-option.selected .option-letter {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .answer-label {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            background: white;
        }

        .answer-label:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .answer-indicator {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-letter {
            width: 32px;
            height: 32px;
            background: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            color: #495057;
            transition: all 0.3s ease;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .timer-display {
            animation: pulse-timer 2s infinite;
        }

        @keyframes pulse-timer {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .modal {
            backdrop-filter: blur(5px);
        }

        .sticky-top {
            z-index: 1020;
        }

        @media (max-width: 576px) {
            .question-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .question-grid {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .col-lg-3 {
                order: 2;
            }
            
            .col-lg-9 {
                order: 1;
            }
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-danger-subtle {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1);
        }
        /* Paksa navbar agar tidak transparan dan memiliki background putih */
        #topnav {
            background: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Pastikan link di navbar terlihat jelas di background putih */
        #topnav .navigation-menu > li > a {
            color: #3c4858 !important;
        }

        /* Ubah warna logo jika perlu */
        #topnav .logo .l-dark {
            display: inline-block !important;
        }
        #topnav .logo .l-light {
            display: none !important;
        }
    </style>

    <script>
        function timer() {
            return {
                timeLeft: {{ $timeLeft }},
                
                startTimer() {
                    this.updateDisplay();
                    const interval = setInterval(() => {
                        this.timeLeft--;
                        this.updateDisplay();
                        
                        if (this.timeLeft <= 0) {
                            clearInterval(interval);
                            @this.call('completeTest');
                        }
                    }, 1000);
                },
                
                updateDisplay() {
                    const minutes = Math.floor(this.timeLeft / 60);
                    const seconds = this.timeLeft % 60;
                    return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                },
                
                formatTime() {
                    return this.updateDisplay();
                },
            }
        }

        // Add image zoom functionality
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.question-image, .answer-image');
            images.forEach(img => {
                img.classList.add('image-zoom');
                img.addEventListener('click', function() {
                    const lightbox = document.createElement('div');
                    lightbox.className = 'lightbox';
                    const clone = this.cloneNode();
                    lightbox.appendChild(clone);
                    document.body.appendChild(lightbox);
                    lightbox.style.display = 'block';
                    
                    lightbox.addEventListener('click', function() {
                        this.remove();
                    });
                });
            });
        });
    </script>
</div>