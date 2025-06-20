# feature/subscriber

## Description

This feature allows you to display a HelloWorld banner at the bottom-right corner of every page on your site.

It’s achieved by leveraging Symfony's EventSubscriber to dynamically inject an HTML element into the response content after the controller has processed the request.

The banner will be visible on all pages where the subscriber is active.
