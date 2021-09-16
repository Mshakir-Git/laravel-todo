<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo</title>
        <style>
            .bg_container{
                background-color: rgba(0, 0, 0, 0.699);
                width:100vw;
                height:100vh;
                position: absolute;
                left: 0px;
                top:0px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .bg_container>form{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            
            .item{
                display: inline-block;
                width:47%;
                background-color: rgb(236, 236, 236);
                padding: 3px;
                overflow: hidden;
                border-radius: 3px;
                margin:3px;
                vertical-align: top;
                max-height: 220px;/*same ass height off add*/


            }
            .container{
                padding: 10px;
                display:inline-block;
                width:33vw;
                top:10px;
                background-color: rgb(255, 128, 128);
                min-height: 95vh;

            }
            .todo_container{

            }
            .doing_container{
                background-color: aqua;
            }    
            .done_container{
                background-color: rgb(0, 255, 76);
            }
            .content{
                display:flex;
            }
            .add{
                display: inline-block;
                text-align: center;
                height:220px;
                
            }
        </style>
        <script>

            function allowDrop(ev){
                ev.preventDefault();
            }

            function drop(ev){
                ev.preventDefault();
                var item=document.getElementById(ev.dataTransfer.getData("txt"))
                if(ev.currentTarget!=item.parentElement){
                    ev.currentTarget.insertBefore(item,ev.currentTarget.childNodes[2])
                    ajaxPost('/todo/public/changestate','state='+ev.currentTarget.id+'&id='+ev.dataTransfer.getData("txt")+'')
                }
                
                //alert(ev.dataTransfer.getData("txt"))
            }
            function drag(ev,obj){
                ev.dataTransfer.setData("txt",ev.target.id)
                
            }
        </script>
        <script>
            function ajaxPost(url,data){
                var httpreq=new XMLHttpRequest();
				httpreq.onreadystatechange = function() {
                    //alert(this.responseText)
				}
            
				httpreq.open("POST",url,true);
                httpreq.setRequestHeader("X-CSRF-TOKEN","{{csrf_token()}}");
                httpreq.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
                
				httpreq.send(data);
            }
            function add(obj){
                var state=obj.id;
                document.getElementById("form").style.display="flex"
                document.getElementById("hidden").value=state;
                document.getElementById("hiddenId").value="new";
                document.getElementById("title").value="";
                document.getElementById("details").value="";
                
            }
            function edit(obj){
                var state=obj.parentNode.id;
                var id=obj.id;
                var title=obj.childNodes[1].innerText;
                var details=obj.childNodes[3].innerText;
                
                document.getElementById("form").style.display="flex"
                document.getElementById("hiddenId").value=id;
                document.getElementById("hidden").value=state;
                document.getElementById("title").value=title;
                document.getElementById("details").value=details;
            }
            function deleteTodo(id){
               
                    ajaxPost('/todo/public/deleteTodo','id='+id+'');
                    document.getElementById(id).remove();
                
            }

            
        </script>

    </head>
    <body>

        @include('blocks.form')

        <div class="content">

        <div ondragover="allowDrop(event)" ondrop="drop(event)" id="todo" class="container todo_container">
          <h1>TODO</h1>
            @foreach($data["todo"] as $item)
                @include('blocks.item')
            @endforeach
            <div id="item" class="item add" onclick="add(this.parentNode)" >
                <h1>+</h1>
            
            </div>
        </div>

        <div ondragover="allowDrop(event)" ondrop="drop(event)" id="doing" class="container doing_container">
            <h1>DOING</h1>

            @foreach($data["doing"] as $item)
                @include('blocks.item')
            @endforeach

            <div id="item" class="item add" onclick="add(this.parentNode)" >
                <h1>+</h1>
            </div>

        </div>

        <div ondragover="allowDrop(event)" ondrop="drop(event)" id="done" class="container done_container">
            <h1>DONE</h1>

            @foreach($data["done"] as $item)
                 @include('blocks.item')
            @endforeach

            <div id="add" class="item add" onclick="add(this.parentNode)">
                <h1>+</h1>
            </div>
            
            
        </div>
    </div>
       
    </body>
</html>
