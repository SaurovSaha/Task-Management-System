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
                                <label class="form-label">Task Name *</label>
                                <input type="text" class="form-control mb-2" id="task-name">

                                <label class="form-label">Project Name *</label>
                                <select type="text" class="form-control mb-2" id="task-project-name">
                                    <option value="Active"></option>
                                </select>

                                <label class="form-label">Description *</label>
                                <textarea class="form-control" id="task-description" rows="3"></textarea>

                                <label class="form-label">Status *</label>
                                <select type="text" class="form-control" id="project-status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>

                                <input type="hidden" class="form-control mb-2" value="1" id="task-user-id">

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
        const TasktName = document.getElementById('task-name').value ;
        const TaskProjectName = document.getElementById('task-project-name').value = project.id;
        const TaskDescription = document.getElementById('task-description').value;
        const TaskStatus = document.getElementById('task-status').value;
        const user_id = document.getElementById('task-user-id').value = user.id;

        // Simple front-end validation
        if (!TasktName || !TaskProjectName || !TaskStatus) {
            alert("All fields are required!");
            return;
        }

        try {
            showLoader();
            closeModal('create-modal');

            const response = await axios.post("/projects", {
                taskName: TasktName,
                project_id: TaskProjectName,
                description: TaskDescription,
                user_id: user_id,
                status: TaskStatus

            });

            if (response.status === 201) {
                document.getElementById("customer-form").reset();
                await getList(currentPage);
            } else {
                alert("Request failed!");
            }
        } catch (error) {
            console.error('Error creating customer:', error);
            alert("An error occurred while saving the customer.");
        } finally {
            hideLoader();
        }
    }
</script>