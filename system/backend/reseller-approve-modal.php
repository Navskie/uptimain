<div class="modal fade" id="approve<?php echo $account_fetch['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Approve Reseller Account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <span>Are you sure you want to approve this reseller?</span>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-info" name="country" href="backend/reseller-approve-process.php?id=<?php echo $account_fetch['id']; ?>">Approve</a>
        </div>
    </div>
    </div>
</div>