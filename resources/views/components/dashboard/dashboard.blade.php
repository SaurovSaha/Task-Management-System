    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Projects</li>
    </ol>
    <div id="projectsContainer" class="row"></div>

    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <span id="modalTaskDetails"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>

        function showLoader() {
            console.log('Loader shown');
        }
    
        function hideLoader() {
            console.log('Loader hidden');
        }
    
        let projectDetailsArray;
    
        ProjectDetails();
    
        async function ProjectDetails() {
            try {
                showLoader();
                const response = await axios.get("/project/details");
                hideLoader();
                projectDetailsArray = response.data;
    
                const projectsContainer = document.getElementById('projectsContainer');
                projectsContainer.innerHTML = '';
    
                projectDetailsArray.forEach((projectDetails, index) => {
                    var isoDateString = projectDetails.created_at;
    
                    var isoDate = new Date(isoDateString);
                    var options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric',
                    };
    
                    var formattedDate = isoDate.toLocaleDateString('en-BD', options);
                    console.log(formattedDate);
    
                    const projectCard = document.createElement('div');
                    projectCard.classList.add('col-md-4', 'mb-4');
                    
    
                    projectCard.innerHTML = `
                        <div class="card">
                            <div class="card-header">
                                <span id="status class="bs-danger-bg-subtle" ">${projectDetails.status}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" id="projectName">${projectDetails.projectName}</h5>
                                <p class="card-text">
                                    Project Deadline: <span id="projectDeadline">${projectDetails.projectDeadline}</span><br>
                                    Created Date: <span id="formattedDate">${formattedDate}</span><br>
                                    Created by: <span id="username">${projectDetails.user ? projectDetails.user.username : 'N/A'}</span><br>

                                </p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal" onclick="openTaskModal(${index})">
                                    View
                                </button>
                            </div>
                        </div>
                    `;
    
                    projectsContainer.appendChild(projectCard);
                });
    
            } catch (error) {
                console.error('Error fetching Project Details:', error);
            }
        }
    
        function openTaskModal(index) {
        const projectDetails = projectDetailsArray[index];

        if (projectDetails) {
            console.log('Project Details:', projectDetails);

            const tasks = projectDetails.tasks;

            if (Array.isArray(tasks) && tasks.length > 0) {
                const taskDetails = tasks.map((task, taskIndex) => `<strong>${taskIndex + 1}. ${task.taskName}:</strong> <br> <strong> Description:</strong> ${task.description || 'N/A'}`).join('<br><br>');
                document.getElementById('modalTaskDetails').innerHTML = taskDetails;
            } else if (tasks === undefined) {
                console.error('Task details are undefined for the selected project.');
                document.getElementById('modalTaskDetails').textContent = 'No tasks available.';
            } else if (tasks.length === 0) {
                console.error('Task details are empty for the selected project.');
                document.getElementById('modalTaskDetails').textContent = 'No tasks available.';
            }
        } else {
            console.error('Project details are undefined for the selected index:', index);
            document.getElementById('modalTaskDetails').textContent = 'Project details are undefined.';
        }
    }

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



