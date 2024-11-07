<div>
<table>
    <thead>
        <tr>
			<th> Блогер </th>
            <th> Дата </th>
            <th> Подписчики </th>
        </tr>
    </thead>
    <tbody>
         @foreach($data as $row)
          <tr>
			  <td> {{$row[0]}} </td>
              <td> {{$row[1]}} </td>
              <td> {{$row[2]}} </td>
          </tr>
         @endforeach
   </tbody>
</table>

</div>
