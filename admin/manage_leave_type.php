<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php $get_id = $_GET['edit']; ?>
<div class="container-fluid">
    <form id="manage_emp_leave">
        <input type="hidden" name="user_id" value="">
        <table class="table">
            <colgroup>
                <col width="10%">
                <col width="70%">
                <col width="20%">
            </colgroup>
            <thead>
                <tr>
                    <th class="py-1 px-1 text-center">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll">
                            </label>
                        </div>
                    </th>
                    <th class="px-2 py-1">Leave Type</th>
                    <th class="px-2 py-1">Leave Credits</th>
                </tr>
            </thead>
            <tbody>
          
                <tr>
                    <td class="text-center">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" class="check_item" id="" name="" value="" 
                            <label for="">
                            </label>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <input type="number" step="any" name="leave_credit[]" value="" class="form-control rounded-0">
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>
</div>
    <?php include('includes/scripts.php')?>
            <?php include('includes/footer.php'); ?>