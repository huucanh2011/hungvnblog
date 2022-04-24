<!-- Logout Modal-->
<div class="modal fade" id="delModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog"
    aria-labelledby="modelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close js-cancel-btn" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Bạn có chắc chắn muốn xoá?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary mr-2 js-cancel-btn" type="button" data-dismiss="modal">Huỷ</button>
                <button class="btn btn-danger js-del-btn" type="button">Xoá</button>
            </div>
        </div>
    </div>
</div>
<form id="js-form-del" action="" method="POST">
    @csrf
    @method('DELETE')
</form>
