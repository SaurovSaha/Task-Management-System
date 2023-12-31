

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card w-100 p-3">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="align-customers-center col">
                                    <h5 class="fw-bold">Profile Info</h5>
                                </div>
                                <div class="align-customers-center col">
                                        <button data-bs-toggle="modal" data-bs-target="#update-modal" class="float-end btn  px-4 btn-success">Edit
                                    </button>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" scope="row">User Name :</th>
                                            <td class="text"> <span id="userName"></span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Mobile :</th>
                                            <td class="text">N/A</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">E-mail :</th>
                                            <td class="text-muted"><span id="Email"></span></td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Registation Date</th>
                                            <td class="text-muted"><span id="formattedDate"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
  
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="{{url('/userLogout')}}" class="btn-success w-100 mt-5 btn btn-sm mx-4">Logout</a>
        </div>
    </div>
</div>



<script>
    
    ProfileDetails();
    
    async function ProfileDetails() {
        try {
            showLoader();
            const response = await axios.get("/userProfile");
            hideLoader();
            const userProfile = response.data;
            var isoDateString = userProfile.created_at;

      
            var isoDate = new Date(isoDateString);
            var options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: 'numeric', 
            minute: 'numeric', 
            second: 'numeric', 
            timeZoneName: 'short',
            currency: 'BDT',
            style: 'currency'
            };

            var formattedDate = isoDate.toLocaleDateString('en-BD', options);
            console.log(formattedDate);

            // Update HTML elements with user profile data
            document.getElementById('userName').textContent = userProfile.username;
            document.getElementById('Email').textContent = userProfile.email;
            document.getElementById('formattedDate').textContent = formattedDate;
            document.getElementById('password').value = userProfile.password;


        } catch (error) {
            console.error('Error fetching user profile:', error);

        }
    }
</script>




