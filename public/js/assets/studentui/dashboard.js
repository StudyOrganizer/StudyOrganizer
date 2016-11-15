//on load
window.onload= function(){ 
    loadAction();
};

//count textarea
function countChar(val) {
  var len = val.value.length;
  if (len >= 351) {
    val.value = val.value.substring(0, 350);
  } else {
    $('#counter').text(350 - len);
  }
};

function postAction() {
    var textarea_content;
    textarea_content = $("#message").val();

    var json = {};
    json['content'] = textarea_content;
    var jsonString = JSON.stringify(json);
    var jsonStringE = jsonString.replace(/\\n/g, '\\\\n');

    $.ajax({
        type: "POST",
        url: '' + window.location.href.slice(0, -2)+ 'api/ajax/messages',
        data: jsonStringE,
        contentType: "application/json",
        dataType: "application/json",
        async: true
    });

    $("#cards").empty();
    $("#cards").val("<br />");
    $("#message").val("");
    loadAction();
}

function loadAction() {
    
  $.ajax({
    type: "GET", 
    url: "" + window.location.href.slice(0, -2)+ "api/ajax/messages",
    async: true
  })
  .success(function( data ) {
            var i;
            if(data._embedded.messages.length == 0) {
                $('#cards').append('<br /><p style="text-align:center;"><i class="fa fa-cubes fa-5x"></i></p>');
            }
            for (i = 0; i < data._embedded.messages.length; i++) {
                $('#cards').append(buildMessageHTMLCard(data._embedded.messages[i].firstname + " " + data._embedded.messages[i].lastname, data._embedded.messages[i].content, data._embedded.messages[i].hashtags, data._embedded.messages[i].updated.date, data._embedded.messages[i].avatar));
            }
            $('#cards').append("<br />");
            document.getElementById('loading').remove();
      })
  .fail(function() {
    alert( "error while loading messages, please retry" );
  });
}

function buildMessageHTMLCard(name, message, hashtags, time, avatar) {
    var code = '<div class="[ panel panel-default ] panel-card"> \
      <div class="dropdown"> \
        <span class="dropdown-toggle" type="button" data-toggle="dropdown"> \
        <span class="[ glyphicon glyphicon-chevron-down ]"></span> \
        </span> \
        <ul class="dropdown-menu" role="menu"> \
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-external-link-square"></i>&nbsp;&nbsp;{{ translate("Open") }}</a></li> \
        <li role="presentation" class="divider"></li> \
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-flag"></i>&nbsp;&nbsp;{{ translate("Report") }}</a></li> \
    </ul> \
    </div> \
    <div class="panel-card-tags"> \
        <ul>'
        +
            makeList(hashtags)
        +
        '</ul> \
        </div> \
    <div class="panel-heading"> \
        <img class="[ img-circle pull-left ]" src="' + window.location.href.slice(0, -2)+ 'api/avatar/' + avatar + '/50" alt="username" /> \
        <h3>' + name + '</h3> \
        <h5><span>' + timeSince(time) + '</span></h5> \
    </div> \
    <div class="panel-body"> \
        <p>' + message + '</p> \
    </div> \
    </div>';

    return code;
}

function makeList(hashtags) {
    var output = "";
    for(var i = 0; i < hashtags.length;i++) {
        output += "<li>" + hashtags[i] + "</li>";
    }
    return output;
}



function timeSince(time) {
    var t = time.split(/[- :]/);
    var date = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years ago";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months ago";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days ago";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours ago";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes ago";
    }
    return Math.floor(seconds) + " seconds ago";
}

function adressGroup(group) {
    $("#message").val("@'" + group + "'");
}
