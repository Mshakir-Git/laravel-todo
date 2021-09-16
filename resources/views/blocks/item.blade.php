<div id="{{$item["id"]}}" class="item" draggable="true" ondragstart="drag(event)" onclick="edit(this)" onmouseover="this.childNodes[5].style.display='block'" onmouseout="this.childNodes[5].style.display='none'">
    
    <h2>{{$item["title"]}}</h2>
    <p>
        {{$item["details"]}}
    </p>
    <button onclick='deleteTodo({{$item["id"]}});event.stopPropagation();' style="float: right;display:none">D</button>

</div>