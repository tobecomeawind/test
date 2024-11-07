<div>
<title>Admin Login Page</title>	
 <form action="{{ route('AdminAuthorization') }}" method="post">
	@csrf
  <div class="container">
    <label for="login"><b>Login</b></label>
    <input type="text" placeholder="Enter login" name="login" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>


</form> 
</div>
