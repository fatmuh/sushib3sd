<div class="modal fade" id="ModalEdit{{ $member->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Member</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('member.update', ['uuid' => $member->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <label class="form-label">Nama Member</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $member->name) }}">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{ old('phone', $member->phone) }}">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3">{{ old('address', $member->address) }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit Member</button>
            </div>
            </form>
        </div>
    </div>
</div>
