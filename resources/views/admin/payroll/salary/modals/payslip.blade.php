<div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payslipModalLabel">Create Payslip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a payslip -->
                <form id="payslipForm">
                    <div class="form-group">
                        <label for="payroll_type">Payroll Type</label>
                        <input type="text" class="form-control" id="payroll_type" placeholder="Enter Payroll Type">
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control" id="salary" placeholder="Enter Salary">
                    </div>
                    <div class="form-group">
                        <label for="net_salary">Net Salary</label>
                        <input type="text" class="form-control" id="net_salary" placeholder="Enter Net Salary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePayslip()">Save Payslip</button>
            </div>
        </div>
    </div>
</div>

<script>
    function savePayslip() {
        // Add your logic to save the payslip details using AJAX or form submission
        // This function will be called when the "Save Payslip" button is clicked
        // You can access the form data using document.getElementById or jQuery
        // For simplicity, let's just log the form data to the console
        const form = document.getElementById('payslipForm');
        const formData = new FormData(form);
        console.log('Form data:', formData);
    }
</script>
