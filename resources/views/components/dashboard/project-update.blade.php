<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Project</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Project Name *</label>
                                <input type="text" class="form-control" id="projectNameUpdate">

                                <label class="form-label">Project Deadline *</label>
                                <input type="text" class="form-control mb-2" id="projectDeadlineUpdate">

                                <label class="form-label">Status *</label>
                                <select type="text" class="form-control mb-2" id="projectStatusUpdate">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>

                                <input type="hidden" class="form-control mb-2" id="projectID">
                                <input type="hidden" class="form-control mb-2" id="projectUserID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="updateProject()" id="update-btn" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function fillUpUpdateForm(id) {
        document.getElementById('projectID').value = id;
        showLoader();
        try {
            const response = await axios.get(`/projects/${id}`);
            const projectData = response.data;
            console.log(projectData);
            document.getElementById('projectNameUpdate').value = projectData.projectName;
            document.getElementById('projectDeadlineUpdate').value = projectData.projectDeadline;
            document.getElementById('projectStatusUpdate').value = projectData.status;
            document.getElementById('projectUserID').value = projectData.user_id;
            openModal('update-modal');
        } catch (error) {
            console.error('Error fetching customer data:', error);
            // Handle error appropriately
        } finally {
            hideLoader();
        }
    }


    async function updateProject() {
        const ProjectName = document.getElementById('projectNameUpdate').value;
        const ProjectDeadline = document.getElementById('projectDeadlineUpdate').value;
        const ProjectStatus = document.getElementById('projectStatusUpdate').value;
        const userID = document.getElementById('projectUserID').value;
        const projectID = document.getElementById('projectID').value;

        if (!ProjectName || !ProjectDeadline || !ProjectStatus) {
            alert("All fields are required!");
            return;
        }

        try {
            closeModal('update-modal');
            showLoader();
            const response = await axios.put(`/projects/${projectID}`, {
                projectName: ProjectName,
                projectDeadline: ProjectDeadline,
                status: ProjectStatus,
                user_id: userID
            });


            if (response.status === 200) {
                document.getElementById("update-form").reset();
                await getList(currentPage);
            } else {
                alert("Request failed!");
            }
        } catch (error) {
            console.error('Error updating project:', error);
            // Handle error appropriately
        } finally {
            hideLoader();
        }
    }
</script>