<div class="modal fade" id="update-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Info</h6>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Username *</label>
                                <input type="text" class="form-control mb-2" id="username">

                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control mb-2" id="email">

                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control mb-2" id="password">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="updateTask()" id="save-btn" class="btn btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    ProfileDetails();
    async function ProfileDetails() {


        showLoader();
        let res=await axios.get("/userProfile")
        hideLoader();

        document.getElementById('username').value=res.data['username']
        document.getElementById('email').value=res.data['email']
        document.getElementById('password').value=res.data['password']


    }

    async function updateTask() {

    const userName = document.getElementById('username').value;
    const Email = document.getElementById('email').value;
    const Password = document.getElementById('password').value;

    if (!userName || !Email ) {
        alert("All fields are required!");
        return;
    }

    try {
        closeModal('update-modal');
        showLoader();
        const response = await axios.put(`/userProfile`, {
            username: userName,
            email: Email,
            password: Password,
        });


        if (response.status === 200) {
            document.getElementById("update-form").reset();
            await getList(currentPage);
        } else {
            alert("Request failed!");
        }
    } catch (error) {
        console.error('Error updating user data:', error);
        // Handle error appropriately
    } finally {
        hideLoader();
    }
    }




</script>