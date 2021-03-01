=== YARPP WPGraphQL ===
Tags: wpgrahql, yarpp, related-posts
Requires at least: 5.1
Tested up to: 5.6.2
Requires PHP: 7.2
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Creates a relatedPosts field in Post type with wp-graphql.
 
== Description ==
 
Creates a relatedPosts field in Post type with wp-graphql. You must have installed wp-graphql and YARPP.

Example of the query:

```
{
  post(id: 235912, idType: DATABASE_ID) {
    title
    relatedPosts(where: { limit: 1 }) {
      nodes {
        title
        slug
      }
    }
  }
}
```
 
== Installation == 
1. Install the plugin wp-graphql
1. Install the plugin yarpp (Yet Another Related Posts Plugin)
1. Configure them following their instructions.
1. Install this plugin
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use it with wp-graphql. The field "relatedPosts" will be available within the Post type in GraphQL schema.
 
== Screenshots ==
 
1. How to query for the title and slug of relatedPosts, limiting to show only one result. /assets/screenshot-1.png
 
== Changelog ==
