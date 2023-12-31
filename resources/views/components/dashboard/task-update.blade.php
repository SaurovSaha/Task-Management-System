<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Task</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Project Name *</label>
                                <input type="text" class="form-control" id="taskNameUpdate">

                                <label class="form-label">Project Name *</label>
                                <select type="text" class="form-control mb-2" id="taskProjectNameUpdate" onfocus="fetchProjectNames()">
                                    <option value="">Select project name</option>
                                </select>
                                

                                <label class="form-label">Description *</label>
                                <textarea class="form-control" id="taskDescriptionUpdate" rows="3"></textarea>

                                <label class="form-label">Status *</label>
                                <select type="text" class="form-control mb-2" id="taskStatusUpdate">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>

                                <input type="hidden" class="form-control mb-2" id="taskUserID">
                                <input type="hidden" class="form-control mb-2" id="taskID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="updateTask()" id="update-btn" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>


    async function fetchProjectNames() {
        try {
            const response = await axios.get("/projects/list");

            if (response.status === 200) {
                const projects = response.data.data;

                if (Array.isArray(projects)) {
                    const selectElement = document.getElementById('taskProjectNameUpdate');
                    selectElement.innerHTML = '<option value="">Select project name</option>';

                    projects.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.id;
                        option.textContent = project.projectName;
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error('Invalid response format. Expected an array.');
                    alert("An error occurred while fetching project names.");
                }
            } else {
                console.error(`Failed to fetch project names. Status: ${response.status}`);
                alert("Failed to fetch project names!");
            }
        } catch (error) {
            console.error('Error fetching project names:', error);
            alert("An error occurred while fetching project names.");
        }
    }

    async function fillUpUpdateForm(id) {
        document.getElementById('taskID').value = id;
        showLoader();
        try {
            const response = await axios.get(`/tasks/${id}`);
            const taskData = response.data;
            console.log(taskData);
            document.getElementById('taskNameUpdate').value = taskData.taskName;
            document.getElementById('taskProjectNameUpdate').value = taskData.project_id;
            document.getElementById('taskDescriptionUpdate').value = taskData.description;
            document.getElementById('taskStatusUpdate').value = taskData.status;
            document.getElementById('taskUserID').value = taskData.user_id;
            openModal('update-modal');
        } catch (error) {
            console.error('Error fetching customer data:', error);
            // Handle error appropriately
        } finally {
            hideLoader();
        }
    }


    async function updateTask() {

        const taskName = document.getElementById('taskNameUpdate').value;
        const taskProjectName = document.getElementById('taskProjectNameUpdate').value;
        const taskDescription = document.getElementById('taskDescriptionUpdate').value;
        const taskStatus = document.getElementById('taskStatusUpdate').value;
        const userID = document.getElementById('taskUserID').value;
        const taskID = document.getElementById('taskID').value;

        if (!taskName || !taskProjectName || !taskDescription || !taskStatus) {
            alert("All fields are required!");
            return;
        }

        try {
            closeModal('update-modal');
            showLoader();
            const response = await axios.put(`/tasks/${taskID}`, {
                taskName: taskName,
                project_id: taskProjectName,
                description: taskDescription,
                status: taskStatus,
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