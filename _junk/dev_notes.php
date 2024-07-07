* Get rid of mx-load (inside initializeTrongateMX())

* Build the functionality of mx-trigger="load"

* Test it.




	 HTMX

     If you want to invoke upon page load...

     <div hx-trigger="load" hx-get="<url>"></div>

     If you want to invoke upon render...
     HTMX...

     	<div hx-trigger="load">x</div>

    -------------------------------------------------

    TRONGATE MX

     If you want to invoke upon page load...

     <div mx-trigger="load" mx-get="<url>"></div>

     If you want to invoke upon render...

     	<div mx-trigger="render">x</div>

     	<button mx-get="xxxx"><i class="fa fa-star"></i> Click</button>


3 TYPES OF SYNTAX

        1).  basic  - accepts an oob element and select (element to be selected) element and replaces the innerHTML.

        EXAMPLE:  mx-select-oob="#happy:#box1"

        2).  more precise - allow users to explicitly define; 'target', 'select' and a 'swap' (e.g., innerHTML, innerText etc)

        EXAMPLE:  mx-select-oob="select:#happy,target:#box2,swap:innerHTML"

        3). multiple oob elements, defined in JSON:


     	mx-select-oob="[{select:#happy,target:#box2,swap:innerHTML},{select:#happy,target:#box2,swap:innerHTML}]"