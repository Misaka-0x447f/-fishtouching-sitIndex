<?php
function echo_list()
{
    require("lib/fileOp.php");
    $file = new fileOp();
    $file->fileSelect("database.json");
    $database = json_encode($file->jsonFileRead());
    echo '
        <div id="nanoAddressBookContainer">
            <div id="search-box">
                <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" id="search-icon-svg">
                    <g>
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                        </path>
                    </g>
                </svg>
                <input id="search-box-int" type="search">
            </div>
            <div id="result-box">

            </div>
            <div id="result-not-found">
                找不到这样的地点。<br/>
                换个搜索词试试，吧                    
            </div>
        </div>
        <style>
            @font-face{
                font-family: "Source Code Pro", "Consolas";
                unicode-range: U+0000-007F;
            }
            #nanoAddressBookContainer, input{
                font-family: "Source Code Pro", "Consolas", "Microsoft JhengHei UI", "SimHei", "STHeiti", sans-serif;
            }
            #nanoAddressBookContainer{
                font-size: 36px;
                width: 100%;
                height: 100%;
                color: #888;
                background: #f1f1f1;
                border: 0;
                overflow: hidden;
            }
            #search-box{
                padding: 0 0.8em 0 2em;
                background: #3668dd;
                color: inherit;
            }
            #search-icon-svg path{
                fill: #ddd;
            }
            #search-icon-svg{
                width: 1.4em;
                height: 1.4em;
                position: absolute;
                top: 0.3em;
                left: 0.3em;
            }
            #search-box-int{
                height: 2em;
                font-size: 1em;
                width: 100%;
                outline: none;
                color: #ddd;
                background: inherit;
                border: 0;
            }
            .results{
                font-size: 1em;
                height: 1.9em;
                background: #ddd;
                padding: 0.3em 0.3em;
                margin-top: 0.1em;
            }
            .results-name{
                font-size: 0.8em;            
            }
            .results-location{
                font-size: 0.6em;
            }
            #result-not-found{
                position: absolute; left: 50%; top: 50%; height: 2em; margin-top: -1em; margin-left: -4.5em;
            }
        </style>
        <script>
            let database = undefined;
            window.onload = function(){
                database = ' . $database . ';
                console.log(database);
                adjust_once();
                setInterval(update, 50);
            };
            function adjust_once(){
                let fontSize = window.innerHeight/743 * 36;
                
                fontSize = fontSize.toString() + "px";

                document.getElementById("nanoAddressBookContainer").style.fontSize = fontSize;
            }
            function update(){
                document.getElementById("search-box-int").focus();
                
                /* promise: the height of every single result is 2.6em. */
                let fontSize = window.innerHeight/743 * 36;

                let search_count_max = Math.floor((window.innerHeight - (fontSize * 2)) / (fontSize * 2.6));

                search_content = document.getElementById("search-box-int").value;
                
                search_storage = [];

                let search_count = 0;
                
                for(let key in database["database"]){
                    if(database["database"][key]["name"].search(search_content) >= 0 || database["database"][key]["location"].search(search_content) >= 0){
                        search_storage.push(database["database"][key]);
                        search_count++;
                        if(search_count > search_count_max){
                            break;
                        }
                    }
                }
                
                document.getElementById("result-box").innerHTML = "";
                
                function create_search_result(name, location){
                    document.getElementById("result-box").innerHTML += 
                    "<div class=\\"results\\">" + 
                    "<div class=\\"results-name results-child\\">" + name + "</div>" +
                    "<div class=\\"results-location results-child\\">" + location + "</div>" + 
                    "</div>";
                }
                
                if(search_storage.length === 0){
                    document.getElementById("result-not-found").style.opacity = 1;
                }else{
                    document.getElementById("result-not-found").style.opacity = 0;
                    search_storage.forEach(function(val){
                        create_search_result(val["name"], val["location"]);
                    })                
                }
            }
        </script>
    ';
}