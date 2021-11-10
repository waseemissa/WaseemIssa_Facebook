$(document).ready(getFriends);
$(document).ready(getPendingFriends);
$(document).ready(getNumberOfFollowers);
$(document).ready(getNotifications);
$(document).ready(getFriendRequests);
$(document).ready(getActivities);
$(document).ready(getFollowers);
$(document).ready(getProfileData);
$(document).ready(getBlockedContacts);
var inputSearch = document.getElementById("search");
inputSearch.addEventListener("keyup", function (event) {
  //if "Enter" is clicked: (13) is the code of the Enter button
  if (event.keyCode === 13) {
    search();
  }
});

function getNumberOfFollowers() {
  getNumberOfFollowersAPI()
    .then((number_of_followers) => {
      document.getElementById("number_of_followers_div").innerHTML =
        number_of_followers.total;
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getNumberOfFollowersAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_number_of_followers.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const number_of_followers = await response.json();
  return number_of_followers;
}

function getNotifications() {
  getNotificationsAPI()
    .then((notifications) => {
      $.each(notifications, function (index, notification) {
        $(".notifications_list").append(
          "<li><a href='#'><div class='drop_content'><p><strong>" +
            notification.text +
            "</strong></p></div></a></li>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getNotificationsAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_all_notifications.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const notifications = await response.json();
  return notifications;
}

function getFriends() {
  getFriendsAPI()
    .then((friends) => {
      $.each(friends, function (index, friend) {
        $(".followers_div").append(
          "<div id='followed_" +
            friend.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            friend.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            friend.first_name +
            " " +
            friend.last_name +
            "</span><span class='block text-sm'>" +
            friend.date_of_birth +
            "</span></div></div><a href='#' onClick='unfollow();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Unfollow <button hidden class ='unfollow_button' id='unfollow_button' value = '" +
            friend.id +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getFriendsAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_friends.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const friends = await response.json();
  return friends;
}

function getPendingFriends() {
  getPendingFriendsAPI()
    .then((pending_friends) => {
      $.each(pending_friends, function (index, pending_friend) {
        $(".pending_followers_div").append(
          "<div id='pending_" +
            pending_friend.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            pending_friend.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            pending_friend.first_name +
            " " +
            pending_friend.last_name +
            "</span><span class='block text-sm'>" +
            pending_friend.date_of_birth +
            "</span></div></div><a href='#' id='cancel_a' onClick='cancelRequest();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Cancel <button hidden class ='cancel_button' id='cancel_button' value = '" +
            pending_friend.id +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getPendingFriendsAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_pending_requests.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const pending_friends = await response.json();
  return pending_friends;
}

function cancelRequest() {
  var id = $(".cancel_button").val();
  cancelRequestAPI()
    .then((cancel_response) => {
      $("#pending_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function cancelRequestAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#cancel_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/cancel_friend_request.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const cancel_response = await response.json();
  return cancel_response;
}

function unfollow() {
  var id = $(".unfollow_button").val();
  unfollowAPI()
    .then((unfriend_response) => {
      $("#followed_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function unfollowAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $(".unfollow_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/remove_friend.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const unfriend_response = await response.json();
  return unfriend_response;
}

function getFriendRequests() {
  getFriendRequestsAPI()
    .then((friend_requests) => {
      $.each(friend_requests, function (index, friend_request) {
        $(".friend_requests_div").append(
          "<div id='request_" +
            friend_request.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><button hidden id='request_notification_id' value='" +
            friend_request.id +
            "'></button><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            friend_request.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            friend_request.text +
            "</span><span class='block text-sm'></span></div></div><a href='#' onClick='acceptFriendRequest();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Accept <button hidden class ='accept_button' id='accept_button' value = '" +
            friend_request.created_by +
            "'></button></a><a href='#' onClick='deleteFriendRequest();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Delete <button hidden class ='delete_button' id='delete_button' value = '" +
            friend_request.created_by +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getFriendRequestsAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_friend_requests.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const friend_requests = await response.json();
  return friend_requests;
}

function getActivities() {
  getActivitiesAPI()
    .then((activities) => {
      $.each(activities, function (index, activity) {
        $(".activities_div").append(
          "<div id='activity_" +
            activity.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            activity.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            activity.text +
            "</span><span class='block text-sm'></span></div></div></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getActivitiesAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_notifications.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const activities = await response.json();
  return activities;
}

function acceptFriendRequest() {
  var id = $("#request_notification_id").val();
  var number_of_followers = parseInt(
    document.getElementById("number_of_followers_div").innerHTML
  );
  console.log(id);
  acceptFriendRequestAPI()
    .then((accept_response) => {
      number_of_followers += 1;
      document.getElementById("number_of_followers_div").innerHTML =
        number_of_followers;
      $("#request_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function acceptFriendRequestAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#accept_button").val();
  var id = $("#request_notification_id").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/accept_friend_request.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
        id: id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const accept_response = await response.json();
  return accept_response;
}

function deleteFriendRequest() {
  var id = $("#request_notification_id").val();
  console.log(id);
  deleteFriendRequestAPI()
    .then((delete_response) => {
      $("#request_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function deleteFriendRequestAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#delete_button").val();
  var id = $("#request_notification_id").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/delete_friend_request.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
        id: id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const delete_response = await response.json();
  return delete_response;
}

function search() {
  searchAPI()
    .then((search_results) => {
      $.each(search_results, function (index, search_result) {
        document.getElementById("search_heading").innerHTML = "Search Results";
        $("#search_results_div").append(
          "<div id='result_" +
            search_result.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href=''><img src='assets/images/" +
            search_result.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            search_result.first_name +
            " " +
            search_result.last_name +
            "</span><span class='block text-sm'>" +
            search_result.email +
            "</span></div></div><a href='#' onClick='follow();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Follow <button hidden class ='follow_button' id='follow_button' value = '" +
            search_result.id +
            "'></button></a><a href='#' onClick='block();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Block <button hidden class ='block_button' id='block_button' value = '" +
            search_result.id +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function searchAPI() {
  var user_id = $("#user_id_button").val();
  var text = $("#search").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/search.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        text: text,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const search_results = await response.json();
  return search_results;
}

function follow() {
  var id = $("#follow_button").val();
  followAPI()
    .then((invitation_response) => {
      $("#result_" + id).hide();
      $(".pending_followers_div").append(
        "<div id='pending_" +
          invitation_response.id +
          "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
          invitation_response.picture +
          "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
          invitation_response.first_name +
          " " +
          invitation_response.last_name +
          "</span><span class='block text-sm'>" +
          invitation_response.date_of_birth +
          "</span></div></div><a href='#' id='cancel_a' onClick='cancelRequest();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Cancel <button hidden class ='cancel_button' id='cancel_button' value = '" +
          invitation_response.id +
          "'></button></a></div>"
      );
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function followAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#follow_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/send_friend_request.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const invitation_response = await response.json();
  return invitation_response;
}

function block() {
  var id = $("#block_button").val();
  blockAPI()
    .then((block_response) => {
      $("#result_" + id).hide();
      $("#followed_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function blockAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#block_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/block_someone.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const block_response = await response.json();
  return block_response;
}

function getFollowers() {
  getFriendsAPI()
    .then((friends) => {
      $.each(friends, function (index, friend) {
        $(".followers_div1").append(
          "<div id='followed_" +
            friend.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            friend.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            friend.first_name +
            " " +
            friend.last_name +
            "</span><span class='block text-sm'>" +
            friend.email +
            "</span></div></div><a href='#' onClick='unfollow();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Unfollow <button hidden class ='unfollow_button' id='unfollow_button' value = '" +
            friend.id +
            "'></button></a><a href='#' onClick='block();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Block <button hidden class ='block_button' id='block_button' value = '" +
            friend.id +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

function editProfile() {
  editProfileAPI()
    .then((edit_response) => {
      document.getElementById("name_a").innerHTML =
        edit_response.first_name + " " + edit_response.last_name;
      window.location.href = "feed.php";
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function editProfileAPI() {
  var user_id = $("#user_id_button").val();
  var first_name = $("#edit_fname").val();
  var last_name = $("#edit_lname").val();
  var email = $("#edit_email").val();
  var date_of_birth = $("#edit_dob").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/edit_profile.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        first_name: first_name,
        last_name: last_name,
        email: email,
        date_of_birth: date_of_birth,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const edit_response = await response.json();
  return edit_response;
}

function editPassword() {
  editPasswordAPI()
    .then((edit_response) => {
      window.location.href = "feed.php";
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function editPasswordAPI() {
  var user_id = $("#user_id_button").val();
  var current_password = $(".password_edit").val();
  var new_password = $(".new_password_edit").val();
  var confirm_password = $(".new_password_confirm_edit").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/edit_password.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        current_password: current_password,
        new_password: new_password,
        confirm_new_password: confirm_password,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const edit_response = await response.json();
  return edit_response;
}

function getProfileData() {
  getProfileDataAPI()
    .then((profile) => {
      $("#edit_fname").val(profile.first_name);
      $("#edit_lname").val(profile.last_name);
      $("#edit_dob").val(profile.date_of_birth);
      $("#edit_email").val(profile.email);
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getProfileDataAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_profile_data.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const profile = await response.json();
  return profile;
}

function getBlockedContacts() {
  getBlockedContactsAPI()
    .then((blocked_contacts) => {
      $.each(blocked_contacts, function (index, blocked_contact) {
        $(".blocked_div").append(
          "<div id='blocked_" +
            blocked_contact.id +
            "' class='divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100'><div class='flex items-center justify-between py-3'><div class='flex flex-1 items-center space-x-4'><a href='profile.html'><img src='assets/images/" +
            blocked_contact.picture +
            "' class='bg-gray-200 rounded-full w-10 h-10'></a><div class='flex flex-col'><span class='block capitalize font-semibold'>" +
            blocked_contact.first_name +
            " " +
            blocked_contact.last_name +
            "</span><span class='block text-sm'>" +
            blocked_contact.email +
            "</span></div></div><a href='#' onClick='unblock();' class='border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800'> Unblock <button hidden class ='unblock_button' id='unblock_button' value = '" +
            blocked_contact.id +
            "'></button></a></div>"
        );
      });
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function getBlockedContactsAPI() {
  var user_id = $("#user_id_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/get_blocked_contacts.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const blocked_contacts = await response.json();
  return blocked_contacts;
}

function unblock() {
  unblockAPI()
    .then((unblock_response) => {
      var id = unblock_response.id;
      $("#blocked_" + id).hide();
    })
    .catch((error) => {
      console.log(error.message);
    });
}

async function unblockAPI() {
  var user_id = $("#user_id_button").val();
  var another_user_id = $("#unblock_button").val();
  const response = await fetch(
    "http://localhost/WaseemIssa_Facebook/php/unblock_someone.php",
    {
      method: "POST",
      body: new URLSearchParams({
        user_id: user_id,
        another_user_id: another_user_id,
      }),
    }
  );

  if (!response.ok) {
    const message = "ERROR OCCURED";
    throw new Error(message);
  }

  const unblock_response = await response.json();
  return unblock_response;
}
