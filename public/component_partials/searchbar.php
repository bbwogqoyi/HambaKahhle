<?php
  function searchbar($action){
    $html = 
      '
        <div class="w-1/3">
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
              <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </span>
            <form id="searchForm" action='.$action.' method="GET" >
              <input type="text" id="searchText" name="searchText" onchange="searchTextChange()"
              class="py-3 pl-10 w-full text-lg bg-white border border-grey-400 rounded-md text-gray-800 placeholder-gray-500  shadow"
              placeholder="Search" />
              <span id="searchBtn" class="absolute inset-y-0 right-0 pl-3 hidden items-center">
                <button type="submit" onclick="search();" class="bg-indigo-300 hover:bg-indigo-500 text-white font-bold py-2 px-6 mr-2 rounded">
                  Go
                </button>
              </span>
            </form>
          </div>
        </div>
        <script>
          function search() {
            var form = document.getElementById("searchForm");
            form.submit();
          };

          function searchTextChange() {
            var searchText = document.getElementById("searchText").value || "";
            if(searchText.length>0) {
              document.getElementById("searchBtn").style.display= "flex";
            }

          };
        </script>
      
      ';
    
    return $html;
  }
?>

