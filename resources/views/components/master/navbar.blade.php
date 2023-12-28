<nav class="navbar navbar-expand-lg bg-success">
  <div class="container ">
    <a class="navbar-brand text-warning fw-bold" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item ">
          <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Project
          </a>
          <ul class="dropdown-menu bg-success-subtle">
            <li><a class="dropdown-item" href="#">Project List</a></li>
            <li><a class="dropdown-item" href="#">Add Project</a></li>

          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tasks
          </a>
          <ul class="dropdown-menu bg-success-subtle">
            <li><a class="dropdown-item" href="#">Brand</a></li>
            <li><a class="dropdown-item" href="#">Category</a></li>
            <li><a class="dropdown-item" href="#">Unit</a></li>
            <li><a class="dropdown-item" href="#">Product</a></li>

          </ul>
        </li>
      </ul>

      {{-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button type="button" class="btn btn-warning">Search</button>
      </form> --}}

      <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Profile
          </a>
          <ul class="dropdown-menu bg-success-subtle">
            <li><a class="dropdown-item" href="{{ url('/Profile') }}">Profile</a></li>
            <li><a class="dropdown-item" href="{{url('/userLogout')}}">Logout</a></li>

          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>

<script>
  ProfileDetails();
  async function ProfileDetails() {

      showLoader();
        let res=await axios.get("/userProfile")
      hideLoader();

      document.getElementById('username').value=res.data['username']



  }
</script>