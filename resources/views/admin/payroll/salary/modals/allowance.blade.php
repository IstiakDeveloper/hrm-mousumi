<div class="modal fade" id="allowanceModal" tabindex="-1" aria-labelledby="allowanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allowanceModalLabel">Create Allowance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating an allowance -->
                <form id="allowanceForm">
                    <div class="form-group">
                        <label for="employee_name">Employee Name</label>
                        <input type="text" class="form-control" id="employee_name" placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group">
                        <label for="allowance_option">Allowance Option</label>
                        <input type="text" class="form-control" id="allowance_option" placeholder="Enter Allowance Option">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" placeholder="Enter Type">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" placeholder="Enter Amount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveAllowance()">Save Allowance</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveAllowance() {
        // Add your logic to save the allowance details using AJAX or form submission
        // This function will be called when the "Save Allowance" button is clicked
        // You can access the form data using document.getElementById or jQuery
        // For simplicity, let's just log the form data to the console
        const form = document.getElementById('allowanceForm');
        const formData = new FormData(form);
        console.log('Form data:', formData);
    }
</script>
