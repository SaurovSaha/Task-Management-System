<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <!-- Bootstrap CSS (assuming you're using Bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Projects</li>
    </ol>

    <!-- Container to hold project details -->
    <div id="projectsContainer" class="row"></div>

    <!-- Bootstrap Modal -->
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
                        Task Name: <span id="modalTaskName"></span><br>
                        Description: <span id="modalDescription"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Axios library (assuming it's not included elsewhere) -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap JS (assuming you're using Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Your script goes here

        // Example function to simulate showLoader and hideLoader
        function showLoader() {
            console.log('Loader shown');
        }

        function hideLoader() {
            console.log('Loader hidden');
        }

        ProjectDetails();

        async function ProjectDetails() {
            try {
                showLoader();
                // Simulated response data with multiple projects
                const response = await axios.get("/project/details");
                hideLoader();
                const projectDetailsArray = response.data;

                // Assuming you have a container div to hold project details
                const projectsContainer = document.getElementById('projectsContainer');

                // Clear existing content in the container
                projectsContainer.innerHTML = '';

                // Iterate through each project
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

                    // Create new elements for each project
                    const projectCard = document.createElement('div');
                    projectCard.classList.add('col-md-4', 'mb-4');

                    projectCard.innerHTML = `
                        <div class="card">
                            <div class="card-header">
                                <span id="status">${projectDetails.status}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" id="projectName">${projectDetails.projectName}</h5>
                                <p class="card-text">
                                    Project Deadline: <span id="projectDeadline">${projectDetails.projectDeadline}</span><br>
                                    Formatted Date: <span id="formattedDate">${formattedDate}</span><br>
                                    User: <span id="username">${projectDetails.project.user ? projectDetails.project.user.username : 'N/A'}</span><br>
                                    Task Name: <span id="taskName">${projectDetails.project.task.taskName}</span><br>
                                    Description: <span id="description">${projectDetails.project.task.description}</span>
                                </p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal" onclick="openTaskModal(${index})">
                                    Go somewhere
                                </button>
                            </div>
                        </div>
                    `;

                    // Append the project card to the container
                    projectsContainer.appendChild(projectCard);
                });

            } catch (error) {
                console.error('Error fetching Project Details:', error);
            }
        }

        // Function to open the task modal with the selected project details
        function openTaskModal(index) {
            const projectDetails = projectDetailsArray[index].project;

            // Update modal content
            document.getElementById('modalTaskName').textContent = projectDetails.tasks.taskName;
            document.getElementById('modalDescription').textContent = projectDetails.task.description;
        }
    </script>
</body>
</html>
