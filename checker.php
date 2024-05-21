<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
  <?php

session_start();
$userLogged = false;
$isAdmin = false;
$is_active = false;
$access_tok = 'null';
if (isset($_SESSION['username'])) {
  $userLogged = true;
  if ($_SESSION['roles'] === "admin") {
    $isAdmin = true;
  }
   if ($_SESSION['status'] === 'active'){
      $is_active =true;
  }
  if($_SESSION['access']!== null){
      $access_tok = $_SESSION['access'];
  }
}
if($is_active === false){
  return header("location: ./dashboard.php?message=account_not_active");
}
if ($userLogged !== true) {
  return header("location: ./?message=user_not_logged");
}
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="https://via.placeholder.com/16x16" >
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/hyper.css?v=2.9" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src="../js/uikit.js"></script>
</head>

<body>

<?php

include("./include/header.php");

?>

<div class="uk-section uk-section-muted">
  <div class="uk-container">
    <div class="uk-background-default uk-border-rounded uk-box-shadow-small">
      <div class="uk-container uk-container-xsmall uk-padding-large">
        <article class="uk-article">
          <h1 class="uk-article-title">Non SK

            <p href="" style="float:right;">
                <label class="switch">
                    <input type="checkbox" onclick="darkLight()" id="checkBox" >
                    <span class="slider"></span>
                   </label>
            </p>
          </h1>
          <div class="uk-article-content">
            <!-- <p class="uk-text-lead uk-text-muted">Warning: don't use generated ccs don't be noob!</p> -->
            <div class="uk-form-stacked uk-margin-medium-top">

                <div class="uk-margin-bottom">
                  <!-- <span id="totalCount">430</span> -->
                    <label class="uk-form-label" for="message"><span >Drop Ccs
                       <span class="tag_required" id="lista_leb">Required</span></span>
                 <span class="tag_total">Total <span id="totalCount">0</span></span>
                  
                  <span class="tag_info">Checked <span id="totalChecked">0</span></span>
                      </label>
                    <div class="uk-form-controls" id="lista_con">
                      <textarea id="message" class="hyper_ccs uk-textarea uk-border-rounded"
                      placeholder="XXXXXXXXXXXXXXXXXX|XX|XXXX|XXX" name="lista" rows="5" minlength="10"
                        required=""></textarea>
                    </div>
                  </div>
                   
              <div class="uk-margin-bottom" id="amount_container">
                <label class="uk-form-label" for="name">Amount <span class="tag_optional">optional</span></label>
                <div class="uk-form-controls hyper_login">
                  <input id="amount" class="hyper_input uk-input uk-border-rounded" name="name"
                   type="number" placeholder="Enter amount (leave blank)" required>
                </div>
              </div>
             
              <!-- <div class="uk-margin-bottom">
                <label class="uk-form-label" for="_subject">SK KEY</label>
                <div class="uk-form-controls hyper_login">
                  <input id="_subject" class="hyper_input uk-input uk-border-rounded" placeholder="sk_live_xxxxxxxx" name="_subject" type="text">
                </div>
              </div> -->
         
              <div class="uk-text-center">
                <button class="uk-button uk-button-primary uk-border-rounded"
                 id="startbtn" type="submit" >start check</button>
                <button class="uk-button uk-button-primary uk-border-rounded" id="stopbtn" type="submit"
                 > Reload It</button>
              
              </div>
</div>




            <div class="uk-card card_cvv uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
                <!-- <a class="uk-position-cover" href="article.html"></a> -->
                <h3 class="uk-card-title uk-margin-remove uk-text-primary green_title">CVV - <span id="cvvCount">0</span>
              
              <span id="showCvv">Show</span>
              <span id="saveCvv">Save</span>
              </h3>
              <span id="cvvList">
                <!-- <p class="uk-margin-small-top">4562463863427327|12|22|223 - Insufficient Funds</p>
                <p class="uk-margin-small-top">5362463863427326|12|27|674 - Insufficient Funds</p> -->
                </span>
               
              </div>

              <!-- ccn  -->
              <div class="uk-card ccn_card uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
               
                <h3 class="uk-card-title uk-margin-remove uk-text-primary warn_title">CCN - <span id="ccnCount">0</span>
                <span id="showCcn">Show</span>
                <span id="saveCcn">Save</span>
              </h3>
                <span id="ccnList">
                  <!-- <p class="uk-margin-small-top">4562463863427327|12|22|223</p> -->
                </span>
                
               
              </div>

              <!-- dead  -->
              <div class="uk-card dead_card uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
         
                <h3 class="uk-card-title uk-margin-remove uk-text-primary dead_title">Ded - <span id="deadCount">0</span> 
                <span id="showDead">Show</span>
              </h3>
                <div id="deadList">
</div>
               
              </div>
              
          </div>
        </article>
      </div>
    </div>
  </div>
</div>

<?php include './include/footer.php'; ?>

<script src="../js/awesomplete.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/hyper.js?v=1.2"></script>
<script src="../js/hyper.notify.js?v=1.2"></script>
<script>
    $(document).ready(() => {
    var e = new Hyperbot({
        timeOut: 5e3,
        runCallBacks: !0
    });
     console.log("checker.js loaded");
    var t = $("#message"),
        a = $("#ccnList"),
        n = $("#cvvList"),
        c = $("#deadList"),
        l = $("#showCvv"),
        s = $("#showCcn"),
        o = $("#showDead"),
        r = $("#hyper_progress"),
        d = $("#saveCvv"),
        h = $("#saveCcn");
    d.hide(), h.hide();
    $("#lista_con"), $("#lista_leb"), $("#amount_container");
    n.hide(), a.hide(), c.hide(), l.click(() => {
        n.slideToggle()
    }), s.click(() => {
        a.slideToggle()
    }), o.click(() => {
        c.slideToggle()
    });
    var m = $("#startbtn"),
        v = $("#stopbtn");

    function p() {
        var e = t.val().split("\n");
        e.splice(0, 1), t.val(e.join("\n"))
    }
    v.hide(), m.click(() => {
        m.html("Please wait..."), async function(l = 35000) {
            var s = $("#id").val(),
                o = $("#sec").val(),
                x = $("#ip").val(),
                z = $("#pass").val(),
                u = t.val(),
                k = u.split("\n"),
                f = k.length,
                g = o || "usd",
                y = 0,
                C = 0,
                w = 0;
var e = document.getElementById("fwtype");
var gate = e.options[e.selectedIndex].value;

            f ? f <= 2e3 ? k.forEach(function(t, i) {
                setTimeout(function() {
                    $.ajax({
                       url: '../api/nonsk.php?lista=' + t,
                        type: "GET",
                        async: !0,
                        success: function(t) {
                            var i;
                            t.match("Approved") ? (p(), y++, i = t + "", n.append("<span>" + i + "<br>"), notify.success(t, "", {
                                duration: 3e3
                            })) : 
                            t.match("CCN") ? (p(), C++, i = t + "", a.append("<span>" + i + "<br>"), notify.success(t, "", {
                                duration: 3e3
                            })) : 
                           t.match("CVV") ? (p(), C++, function(e) {
                                a.append("<span>" + e + "<br>")
                            }(t + "")) : (p(), w++, function(e) {
                                c.append("<span>" + e + "<br>")
                            }(t + "")), $("#totalCount").html(f);
                            var l = parseInt(y) + parseInt(C) + parseInt(w);
                            $("#cvvCount").html(y), $("#ccnCount").html(C), $("#deadCount").html(w), $("#totalChecked").html(l), $("#cLive2").html(y), $("#cWarn2").html(C), $("#cDie2").html(w);
                            var s = l / f * 100;
                            0 !== parseInt(y) && 100 === s && (d.show(), d.click(async () => {
                                var t = $("#cvvList").text();
                                return e.saveFile({
                                    fileName: "x" + y + "_hyper_cvv",
                                    fileExten: "txt",
                                    fileData: ["ᴄʜᴇᴄᴋᴇʀ: Dylan\nɢᴀᴛᴇ: sᴛʀɪᴘᴇ ᴄᴜsᴛᴏᴍ\n--------------\n".replace(/^\s*\n/gm, "") + t.replaceAll("#CVV", "\n").replace(/^\s*\n/gm, "")],
                                    saveData: !0
                                })
                            })), 0 !== parseInt(C) && 100 === s && (h.show(), h.click(async () => {
                                var t = $("#ccnList").text();
                                return e.saveFile({
                                    fileName: "x" + C + "_hyper_ccn",
                                    fileExten: "txt",
                                    fileData: ["ᴄʜᴇᴄᴋᴇʀ: Dylan\nɢᴀᴛᴇ: sᴛʀɪᴘᴇ ᴄᴜsᴛᴏᴍ\n--------------\n".replace(/^\s*\n/gm, "") + t.replaceAll("CCN", "\n").replace(/^\s*\n/gm, "")],
                                    saveData: !0
                                })
                            })), r.css({
                                width: `${s.toFixed(0)+"%"}`,
                                height: "3px"
                            }), r.addClass("animate__animated animate__lightSpeedInLeft");
                            var o = "Processing..." + s.toFixed(0) + "%";
                            m.html(o), m.addClass(" animate__animated animate__flip "), 100 === s && (m.css({
                                color: "#0d8f3b",
                                background: "#0eab450d"
                            }), m.html("Checking completed!"), setTimeout(() => {
                                m.html("Loading...")
                            }, 5000), setTimeout(() => {
                                m.hide(), v.show(), v.html("Reload checker")
                            }, 5500), v.click(() => {
                                window.location.reload()
                            }))
                        }
                    })
                }, l * i)
            }) : window.location.reload() : notify.error("Please add a cc!", "", {
                duration: 5e3
            })
        }()
    })
});
    </script>

</body>

</html>