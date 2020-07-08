<?php

return 1; /*"
<div class='sotbify-insta'>

  <div class='sotbify-insta__wrapper'>
  	{% for i in (1..8) %}
    <div class='sotbify-insta__item'>
    	<img class='sotbify-insta__item-image' src=\"#\">
    </div>
    {% endfor %}
  </div>

</div>


<style>
.sotbify-insta {
    display: flex;
    max-width: {{ section.settings.insta_section_width }}%;
		background-color: #F7F7F7;
		margin: 0 auto;
	}

    .sotbify-insta__wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
      	grid-gap: {{section.settings.insta_section_gap}}px;
		width: 100%;
		position: relative;
    }

    .sotbify-insta__item {
    padding-top: 100%;
		background-color: #fefefe;
		position: relative;
    }

    .sotbify-insta__item-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
</style>

{% stylesheet %}

{% endstylesheet %}

{% javascript %}
{% endjavascript %}

{% schema %}
  {
      \"name\": \"Insta-App\",
    \"settings\": [
      {
          \"type\":   \"range\",
          \"id\":     \"insta_section_width\",
          \"min\":       50,
          \"max\":       100,
          \"step\":      5,
          \"unit\":      \"%\",
          \"label\":     \"Content-width\",
          \"default\":   100
      },
{
    \"type\":   \"range\",
          \"id\":     \"insta_section_gap\",
          \"min\":       0,
          \"max\":       100,
          \"step\":      2,
          \"unit\":      \"px\",
          \"label\":     \"Content-gap\",
          \"default\":   0
      }
	],
	\"presets\":
		[
			{
                \"name\":\"Sotbify Instagram\",
				\"category\":\"Sotbify\"
			}
		]
  }




{% endschema %}

";
