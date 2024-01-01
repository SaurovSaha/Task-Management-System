<div class="modal fade" id="create-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Task</h6>
            </div>
            <div class="modal-body">
                <form id="task-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Task Name *</label>
                                <input type="text" class="form-control mb-2" id="task-name">

                                <label class="form-label">Project Name *</label>
                                <!-- Change this line in your HTML -->
                                <select type="text" class="form-control mb-2" id="task-project-name" onfocus="fetchProjectNames()">
                                    <option value="">Select project name</option>
                                </select>
                                

                                <label class="form-label">Description *</label>
                                <textarea class="form-control" id="task-description" rows="3"></textarea>

                                <label class="form-label">Status *</label>
                                <select type="text" class="form-control" id="task-status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>

                                <input type="hidden" class="form-control mb-2" value="" id="user_id">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="saveTask()" id="save-btn" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>


    async function fetchProjectNames() {
        try {
            const response = await axios.get("/projects/list");

            if ('data' in response) {
                const projects = response.data.data;

                if (Array.isArray(projects)) {
                    const selectElement = document.getElementById('task-project-name');
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


    async function fetchUserId() {
        try {
            const response = await axios.get("/userProfile");
            if ('data' in response && 'id' in response.data) {
                return response.data.id;
            } else {
                console.error('Failed to fetch user ID.');
            }
        } catch (error) {
            console.error('Error fetching user ID:', error);
        }
    }

    function setUserId() {
        fetchUserId().then((userId) => {
            document.getElementById('user_id').value = userId;
        });
    }

    setUserId()

    async function saveTask() {

        const TasktName = document.getElementById('task-name').value ;
        const TaskProjectName = document.getElementById('task-project-name').value;
        const TaskDescription = document.getElementById('task-description').value;
        const TaskStatus = document.getElementById('task-status').value;
        const TaskUserid = document.getElementById('user_id').value;


        if (!TasktName || !TaskProjectName || !TaskDescription || !TaskStatus) {
            alert("All fields are required!");
            return;
        }

        try {
            showLoader();
            closeModal('create-modal');

            const response = await axios.post("/tasks", {
                taskName: TasktName,
                project_id: TaskProjectName,
                description: TaskDescription,
                user_id: TaskUserid,
                status: TaskStatus

            });

            if (response.status === 201) {
                document.getElementById("task-form").reset();
                await getList(currentPage);
            } else {
                alert("Request failed!");
            }
        } catch (error) {
            console.error('Error creating Task:', error);
            alert("An error occurred while saving the task.");
        } finally {
            hideLoader();
        }
    }
    
</script>