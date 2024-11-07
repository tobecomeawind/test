<div>
<form action="{{ route('RedactBloger') }}" method="post">
@csrf
<div>
<center>
<div class="container">
	<input type="hidden" id="blogerId" name="id" value="{{ $data['id'] }}" />
 	<label for="name"><b>Name</b></label>
	<input type="text" placeholder="Enter name" value="{{ $data['name'] }}" name="name" required>

	<label for="description"><b>Description</b></label>
	<input type="description" placeholder="Enter description" value="{{ $data['description'] }}" name="description" required>

	<label for="link"><b>Link</b></label>
	<input type="text" placeholder="Enter link" value="{{ $data['link'] }}" name="link" required>
   
	<button type="submit">Изменить данные</button>
</div>
</form>

</div>
