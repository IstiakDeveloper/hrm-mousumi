<div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanModalLabel">Create Loan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a loan -->
                <form id="loanForm">
                    <div class="form-group">
                        <label for="employee_name_loan">Employee Name</label>
                        <input type="text" class="form-control" id="employee_name_loan" placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group">
                        <label for="loan_option">Loan Option</label>
                        <input type="text" class="form-control" id="loan_option" placeholder="Enter Loan Option">
                    </div>
                    <div class="form-group">
                        <label for="title_loan">Title</label>
                        <input type="text" class="form-control" id="title_loan" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="type_loan">Type</label>
                        <input type="text" class="form-control" id="type_loan" placeholder="Enter Type">
                    </div>
                    <div class="form-group">
                        <label for="loan_amount">Loan Amount</label>
                        <input type="text" class="form-control" id="loan_amount" placeholder="Enter Loan Amount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveLoan()">Save Loan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveLoan() {
        // Add your logic to save the loan details using AJAX or form submission
        // This function will be called when the "Save Loan" button is clicked
        // You can access the form data using document.getElementById or jQuery
        // For simplicity, let's just log the form data to the console
        const form = document.getElementById('loanForm');
        const formData = new FormData(form);
        console.log('Form data:', formData);
    }
</script>
