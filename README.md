<h1 align="center">
  The Bored Website
</h1>
<p align="center">Content creation, upload, and "random" content retrieval <br>
This was built as my first year project as part of a group at the University of Manchester <br>
Try it out online at <a href="http://bored.actilis.org">http://bored.actilis.org</a></p>
<div align="center"><a href="https://github.com/simeonedef"><img alt="@simeonedef" src="https://img.shields.io/badge/Author-Sim%C3%A9one%20de%20Fremond-lightgrey.svg" /></a>
<img alt="HTML 5" src="https://img.shields.io/badge/html-5-orange.svg" />
<img alt="CSS 3" src="https://img.shields.io/badge/css-3-blue.svg" />
<img alt="Bootstrap 3" src="https://img.shields.io/badge/bootstrap-3-green.svg" />
<img alt="PHP 5.6" src="https://img.shields.io/badge/php-5.6-yellow.svg" />
</div>

## About
The original idea of the project was to build a "boredom killer" in the form of a website that would give its visitor an interesting piece of content, 
something the user did not know he wanted but that we knew he did. This is what spawned the idea of this "magic button" behind which lies content that we
think the user will like.

## Uploading
There exists 4 types of content:
* Video: youtube video link
* Article (which can include images, text, links, ...): features a markdown WYSIWG editor
* Language module: audio files for words' pronunciation and their translation to english
* Quiz module: one MCQ with 4 answers
The contents have to be rated with appropriate tags to be classified in categories.
Approved users can then upload content once logged in that will then be stored inside the database.
Users can then look in their profile section to see all their own uploaded content.

## Retrieving content
The content is then retrieved through the main "get excited" buttons located either at the top of each page or at the bottom of the homepage. 
While this button at first works randomly, over time, if a user is logged in, its rating will allow the system to provide tailored content through the use of the tags.

## Final words
This project is quite simple and has many flaws, it is mainly here as a proof of concept and not as a final, ready to deploy version of the idea. 
