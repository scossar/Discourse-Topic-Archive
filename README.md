# Discourse Topic Archive

**note:** This is a neat plugin, but it's using the jQuery `append()` method to add html strings from an untrusted source to the document. There is a better way to do it. For the moment I have commented out `line:145` of `wp-discourse-topic.js`. I'll update it soon.

Saves a Discourse topic as a WordPress post

This plugin adds a Discourse topic meta-box to the WordPress admin screen. The meta-box accepts a URL for a Discourse
topic and returns the topic's posts. The posts can then be added to the WordPress post editor.

![alt tag](https://cloud.githubusercontent.com/assets/2975917/15486495/3136662e-20fb-11e6-9f5d-5133e8b6b1d0.png)
