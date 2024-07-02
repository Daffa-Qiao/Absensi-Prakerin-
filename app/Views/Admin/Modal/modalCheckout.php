<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="modalCheckoutLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCheckoutLabel">Checkout User</h5>
                <button type="button" class="close tombol-tutup-checkout" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="inputID">
                <div class="mb-3">
                    <label for="inputCheckout">Check-Out : </label>
                    <input type="time" name="checkout" id="inputCheckout" class="form-control">
                    <div class="invalid-feedback errorCheckout">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tombol-tutup-checkout"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info bg-gradient-info" id="tombolCheckout">Checkout</button>
            </div>
        </div>
    </div>
</div>