const request = new XMLHttpRequest();

const url = "https://fad45d6ce236.ngrok.io/api/instagram/posts?host=" + document.location.host;
console.log('start script');

request.open('GET', url);

request.setRequestHeader('Content-Type', 'application/x-www-form-url');
request.setRequestHeader('Access-Control-Allow-Origin','*');
request.setRequestHeader('Access-Control-Allow-Methods','GET');
request.setRequestHeader('Access-Control-Allow-Headers','X-Auth-Token,Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

request.addEventListener("readystatechange", () => {
    request.onload = () =>{
        //console.log( request );
        if (request.response) {
            let posts = JSON.parse(request.response);
            let postsContainers = document.querySelectorAll('.sotbify-insta__item-image');
            for (let i=0; i < posts.length; i++) {
                postsContainers[i].src = posts[i]['media_url']
            }
        } else {
            return false;
        }
    }
});

request.send();

