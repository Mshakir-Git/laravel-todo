
<div class="bg_container" id="form" style="display:none;" onmousedown="this.style.display='none'">

<form method="post" action="/todo/public/post" onmousedown="event.stopPropagation();">
    @csrf
<input type="hidden" name="state" id="hidden">
<input type="hidden" name="id" id="hiddenId">
<input type="text" name="title" id="title"  style="width:300px;height:50px;font-size: 20px;font-weight: 600;"  placeholder="Title">
<textarea name="details" id="details"  style="width:300px;margin-bottom:10px;margin-top:10px;height:200px;"  placeholder="Details"></textarea>
<input type="submit" name="submit" value="OK" style="width:100px;">
</form>

</div>
