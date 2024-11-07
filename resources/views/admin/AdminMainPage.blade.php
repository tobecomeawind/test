<!DOCTYPE html>
<div>
<title>Admin page</title>	
<!--Создание нового аккаунта -->
<form action="{{ route('BlogerCreate') }}" method="post">
@csrf
<div>
<center>
<div class="container">
 	<label for="name"><b>Name</b></label>
	<input type="text" placeholder="Enter name" name="name" required>

	<label for="description"><b>Description</b></label>
	<input type="description" placeholder="Enter description" name="description" required>

	<label for="link"><b>Link</b></label>
	<input type="text" placeholder="Enter link" name="link" required>
   
	<button type="submit">Создать аккаунт</button>
</div>
</form>


<!-- Добавление подписчиков на определенную дату -->
<form action="{{ route('AddSubscribers') }}" method="post">
@csrf
  <div class="container">
    <label for="id"><b>Bloger ID</b></label>
    <input type="text" placeholder="Enter ID" name="id" required>

	<label for="date">Date:</label>
	<input type="date" id="start" name="date" value="{{ date('Y-m-d') }}"/>

    <label for="value"><b>Subscribers Value</b></label>
    <input type="text" placeholder="Enter subcribers count" name="value" required>
    
	<button type="submit">Создать</button>
  </div>
</form>


<!--Редактирование аккаунта -->
<form action="{{ route('RedactBlogerPage') }}" method="post">
@csrf

  <div class="container">
    <label for="id"><b>Bloger ID</b></label>
    <input type="text" placeholder="Enter ID" name="id" required>
    
	<button type="submit">Изменить</button>
  </div>
</form>


</center>
</div>
</div>
