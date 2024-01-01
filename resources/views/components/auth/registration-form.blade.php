<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card w-100  p-4">
                <div class="card-body">
                    <h6>Sign Up</h6>
                    <hr/>
                        <label>User Name</label>
                         <input id="username" placeholder="Username" class="form-control form-control-sm" type="text" required/>
                        <br/>
                            
                          
                        <label>Email Address</label>
                        <input id="email" placeholder="User Email" class="form-control form-control-sm" type="email" required/>
                            
                        <br/>
                        <label>Password</label>
                        <input id="password" placeholder="User Password" class="form-control form-control-sm" type="password" required/>
                          
                        <br/>
                        <button onclick="Save()" class="btn mt-3 btn-sm w-100 btn-success">Submit</button>
                        <hr/>
                        <a href="{{ url('/Login') }}"><p class="text-center" >Aleardy registered?</p> </a>
                </div>     
            </div>
        </div>
    </div>
</div>


<script>

   async function Save() {

       let username=document.getElementById('username').value;
       let email=document.getElementById('email').value;
       let password=document.getElementById('password').value;

       let PostObj={
           "username":username,
           "email":email,
           "password":password
       }

       showLoader();
       let res=await axios.post("/userRegistration",PostObj)
       hideLoader();

       if(res.data['status']==="success"){
            alert(res.data['message']);
            window.location.href="/Login";
       }else {
           alert(res.data['message'])
       }

   }


</script>


