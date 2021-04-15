<!DOCTYPE html>
<html>
<body>
<h1> Summary</h1>

<label for="fname">Claim</label><br>

<form action="/action_page.php">

<textarea id="w3review" name="w3review" rows="2" cols="20">

  </textarea>
  <br><br>
  <label for="w3review">Can you reproduce this claim?  </label>
  <button type="button" onclick="alert('Hello world!')">YES</button>
  <button type="button" onclick="alert('Hello world!')">NO</button>
  
  </form>
  
  <br>


<form>
  <label for="fname">Source Code</label><br>
  <input type="text" id="fname" name="fname" value="" readonly><br>
  <br>
  
  <label for="lname">Datasets</label><br>
  <input type="text" id="lname" name="lname" value="">
  <br>
  <br>
  
  <label for="lname">Experimental Results</label><br>
  <input type="text" id="lname" name="lname" value="">
  <br>
  <br>
   <label for="w3review">Add another claim </label>
<button type="button" onclick="alert('Hello world!')">ADD</button>
<!-- </form>


<td><form method = 'POST' action="{{URL::to('/search')}}">
{{ csrf_field() }}

<div class="form-box">
         
          <input type ="text" class="search" name="q" placeholder = "Search" id="transcript" />
         
          <button class ="search-btn" type="submit"> Search</button><br>
</div>
<input type='hidden' name='title' value='<? echo $title?>'/><button class='btn btn-primary'>Back</button>
</form></td> -->

<form id="labnol" action="{{URL::to('/search')}}" method="POST" role="search">
        {{ csrf_field() }}
    
		  <div class="form-box">
         
      <button onclick="myFunction()">Back</button>

         
</div>


</form>

</body>
</html>


