<div class="modal fade" id="create-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Customer</h6>
            </div>
            <div class="modal-body">
                <form id="customer-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Project Name *</label>
                                <input type="text" class="form-control mb-2" id="project-name">
                                <label class="form-label">Project Deadline *</label>
                                <input type="text" class="form-control mb-2" id="project-deadline">
                                <input type="hidden" class="form-control mb-2" value="1" id="project-user-id">
                                <label class="form-label">Status *</label>
                                <select type="text" class="form-control" id="project-status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="saveCustomer()" id="save-btn" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function saveCustomer() {
        const ProjectName = document.getElementById('project-name').value;
        const ProjectDeadline = document.getElementById('project-deadline').value;
        const ProjectStatus = document.getElementById('project-status').value;
        const user_id = document.getElementById('project-user-id').value;

        // Simple front-end validation
        if (!ProjectName || !ProjectDeadline || !ProjectStatus) {
            alert("All fields are required!");
            return;
        }

        try {
            showLoader();
            closeModal('create-modal');

            const response = await axios.post("/projects", {
                projectName: ProjectName,
                projectDeadline: ProjectDeadline,
                user_id: user_id,
                status: ProjectStatus

            });

            if (response.status === 201) {
                document.getElementById("customer-form").reset();
                await getList(currentPage);
            } else {
                alert("Request failed!");
            }
        } catch (error) {
            console.error('Error creating project:', error);
            alert("An error occurred while saving the project.");
        } finally {
            hideLoader();
        }
    }
</script>