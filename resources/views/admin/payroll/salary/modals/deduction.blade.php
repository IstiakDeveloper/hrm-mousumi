<div class="modal fade" id="deductionModal" tabindex="-1" aria-labelledby="deductionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deductionModalLabel">Create Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a deduction -->
                <form id="deductionForm">
                    <div class="form-group">
                        <label for="employee_name_deduction">Employee Name</label>
                        <input type="text" class="form-control" id="employee_name_deduction" placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group">
                        <label for="deduction_option">Deduction Option</label>
                        <input type="text" class="form-control" id="deduction_option" placeholder="Enter Deduction Option">
                    </div>
                    <div class="form-group">
                        <label for="title_deduction">Title</label>
                        <input type="text" class="form-control" id="title_deduction" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="type_deduction">Type</label>
                        <input type="text" class="form-control" id="type_deduction" placeholder="Enter Type">
                    </div>
                    <div class="form-group">
                        <label for="amount_deduction">Deduction Amount</label>
                        <input type="text" class="form-control" id="amount_deduction" placeholder="Enter Deduction Amount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveDeduction()">Save Deduction</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveDeduction() {
        // Add your logic to save the deduction details using AJAX or form submission
        // This function will be called when the "Save Deduction" button is clicked
        // You can access the form data using document.getElementById or jQuery
        // For simplicity, let's just log the form data to the console
        const form = document.getElementById('deductionForm');
        const formData = new FormData(form);
        console.log('Form data:', formData);
    }
</script>
