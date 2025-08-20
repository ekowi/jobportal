<div class="container mt-5">
    <div class="rounded shadow p-4">
        <form wire:submit.prevent="save">
            <h5>Personal Detail :</h5>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">First Name:<span class="text-danger">*</span></label>
                        <input wire:model="nama_depan" type="text" class="form-control" placeholder="First Name :">
                        @error('nama_depan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Last Name:<span class="text-danger">*</span></label>
                        <input wire:model="nama_belakang" type="text" class="form-control" placeholder="Last Name :">
                        @error('nama_belakang') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Phone Number:<span class="text-danger">*</span></label>
                        <input wire:model="no_telpon" type="text" class="form-control" placeholder="Phone Number :">
                        @error('no_telpon') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address:</label>
                        <input wire:model="alamat" type="text" class="form-control" placeholder="Address :">
                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Postal Code:</label>
                        <input wire:model="kode_pos" type="text" class="form-control" placeholder="Postal Code :">
                        @error('kode_pos') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Country:</label>
                        <input wire:model="negara" type="text" class="form-control" placeholder="Country :">
                        @error('negara') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">National ID (KTP):</label>
                        <input wire:model="no_ktp" type="text" class="form-control" placeholder="National ID :">
                        @error('no_ktp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tax ID (NPWP):</label>
                        <input wire:model="no_npwp" type="text" class="form-control" placeholder="Tax ID :">
                        @error('no_npwp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Place of Birth:</label>
                        <input wire:model="tempat_lahir" type="text" class="form-control" placeholder="Place of Birth :">
                        @error('tempat_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Date of Birth:</label>
                        <input wire:model="tanggal_lahir" type="date" class="form-control">
                        @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gender:</label>
                        <select wire:model="jenis_kelamin" class="form-control form-select">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('jenis_kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Marital Status:</label>
                        <select wire:model="status_perkawinan" class="form-control form-select">
                            <option value="">Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                        @error('status_perkawinan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Religion:</label>
                        <input wire:model="agama" type="text" class="form-control" placeholder="Religion :">
                        @error('agama') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alternate Phone:</label>
                        <input wire:model="no_telpon_alternatif" type="text" class="form-control" placeholder="Alternate Phone :">
                        @error('no_telpon_alternatif') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Skills:</label>
                        <textarea wire:model="kemampuan" rows="4" class="form-control" placeholder="Skills :"></textarea>
                        @error('kemampuan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-12">
                    <input type="submit" class="submitBnt btn btn-primary" value="Save Changes">
                </div>
            </div>
        </form>
    </div>
</div>
