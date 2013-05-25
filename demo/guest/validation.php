<html>
<head>
<title>Guest-Index</title>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.validate.js" mce_src="js/jquery.validate.js"></script>
<script src="js/jquery.validate.min.js"></script>
<style>
.ui-collapsible.ui-collapsible-collapsed .ui-collapsible-heading .ui-icon-plus,
.ui-icon-arrow-r { background-position: -108px 0; }
.ui-icon-arrow-l { background-position: -144px 0; }
.ui-icon-arrow-u { background-position: -180px 0; }
.ui-collapsible .ui-collapsible-heading .ui-icon-minus,
.ui-icon-arrow-d { background-position: -216px 0; }
#errorWrapper{
 border: 1px solid  #456f9a /*{b-bar-border}*/;
  background:       #5e87b0 /*{b-bar-background-color}*/;
  color:          #fff /*{b-bar-color}*/;
  font-weight: bold;
  text-shadow: 0 /*{b-bar-shadow-x}*/ 1px /*{b-bar-shadow-y}*/ 1px /*{b-bar-shadow-radius}*/ #3e6790 /*{b-bar-shadow-color}*/;
  background-image: -webkit-gradient(linear, left top, left bottom, from( #6facd5 /*{b-bar-background-start}*/), to( #497bae /*{b-bar-background-end}*/)); /* Saf4+, Chrome */
  background-image: -webkit-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Chrome 10+, Saf5.1+ */
  background-image:    -moz-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* FF3.6 */
  background-image:     -ms-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* IE10 */
  background-image:      -o-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Opera 11.10+ */
  background-image:         linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/);
position:absolute;
z-index: 100;
width:33%;
left:33%;
top:30%;

border-style:none
}
#errorClose{
float:right;
}


</style>
<script>

$(document).ready(function () {
        // 1. prepare the validation rules and messages.
        var rules = {
            textbox1: {
                required: true,
                minlength: 2
            },
            textbox2: "required",
            textbox3: "required"
        };
        var messages = {
            textbox1: {
                required: "textbox1 is required",
                minlength: "textbox1 needs to be at least length 2"
            },
            textbox2: "textbox2 is requried",
            textbox3: "textbox3 is required"
        };
 
        // 2. Initiate the validator
        var validator
            = new jQueryValidatorWrapper("FormToValidate",
                rules, messages);
 
        // 3. Set the click event to do the validation
        $("#btnValidate").click(function () {
            if (!validator.validate())
                return;
 
            alert("Validation Success!");
        });
    });
       

</script>
</head>
<body>
 
<form id="FormToValidate" action="#">
<table>
    <tr>
        <td>
            <input type="text" id="textbox1" name="textbox1" />
        </td>
        <td>
            <input type="text" id="textbox2" name="textbox2" />
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" id="textbox3" name="textbox3" />
        </td>
        <td>
            <input type="button" id="btnValidate"
                style="width: 100%" value="Validate" />
        </td>
    </tr>
</table>
</form>
 
</body>
</html>