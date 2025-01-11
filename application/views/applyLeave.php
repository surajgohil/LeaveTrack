<!-- Apply Leave -->
<div class="mx-auto p-3 pt-5 mb-5 page" style="width: 50%; background: #343434; border-radius: 10px; margin-top: 8%;">
    <h3 class="text-center mb-4">Apply for Leave</h3>
    <form id="leaveForm" class="p-4 bg-black rounded">
        <div class="form-group">
            <label for="employeeCode">Employee Code</label>
            <input type="text" id="employeeCode" name="employeeCode" class="form-control" placeholder="Enter Employee Code" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fromDate">From Date</label>
                <input type="date" id="fromDate" name="fromDate" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="toDate">To Date</label>
                <input type="date" id="toDate" name="toDate" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="leaveType">Leave Type</label>
            <select id="leaveType" name="leaveType" class="form-control" required>
                <option value="" disabled selected>Select Leave Type</option>
                <?php
                    foreach($data as $option){
                        echo "<option value=".$option['id'].">".$option['leave_type']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea id="comments" name="comments" class="form-control" rows="3" maxlength="300" placeholder="Enter comments (300 characters max)"></textarea>
        </div>

        <button type="submit" class="btn btn-warning btn-block">Submit</button>
    </form>
</div>

