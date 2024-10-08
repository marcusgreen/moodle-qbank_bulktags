# moodle-qbank_bulktags
![PHP Support](https://img.shields.io/badge/php-8.1--8.3-blue)[![Moodle Plugin CI](https://github.com/marcusgreen/moodle-qbank_bulktags/actions/workflows/moodle-ci.yml/badge.svg)](https://github.com/marcusgreen/moodle-qtype_gapfill/actions/workflows/moodle-ci.yml)[![Moodle Support](https://img.shields.io/badge/Moodle-4.4+-orange)](https://github.com/marcusgreen/moodle-qbank_bulktags/actions)

This is a Moodle Question bank plugin to allow bulk updating of question tags.
It was mainly created at MoodleDACH24 in Vienna. With thanks to Stephan Robotta
https://github.com/srobotta for collaboration and inspiration.

For custom development and consultancy contact Moodle Partner Catalyst EU (https://www.catalyst-eu.net/).

# Why was it created?

Question tags are metadata and can be used to filter questions within the question bank. For example you might assign a difficulty level, or a subject area. A question can only be in a single category but can have an arbitrary number of tags.

Updating the tags on a single question with 4 tags can be time consuming. It typically takes 9 clicks to update a single question. If you have a a category with 20 questions that is 180 clicks. And of course there is a good chance of making a mistake. With this plugin the whole task will typically take 10 clicks.

#  Installation

To install it from the root of a moodle installation

git clone git@github.com:marcusgreen/moodle-question_bank_bulktags.git question/bank/bulktags

For Moodle development and consultancy, contact Moodle partner Catalyst EU

https://www.catalyst-eu.net/contact-us/brighton

The latest source can be found at

https://github.com/marcusgreen/moodle-qbank_bulktags

![gif animation of bulk tagging of questions](./docs/images/bulk_question_tags.gif)
