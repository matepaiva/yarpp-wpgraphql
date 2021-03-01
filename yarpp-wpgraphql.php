<?php

/**
 * Plugin Name: YARPP WPGraphQL
 * Plugin URI: https://github.com/matepaiva/yarpp-wpgraphql
 * Version: 0.0.1
 * Author: Matheus Paiva
 * Author URI: https://github.com/matepaiva/
 * Description: Creates a relatedPosts field in Post type with wp-graphql. You must have installed wp-graphql and YARPP.
 * License: GPLv2 or later
 */


add_action('graphql_register_types', function () {
  global $yarpp;
  if ($yarpp) {
    \register_graphql_connection([
      'fromType' => 'Post',
      'fromFieldName' => 'relatedPosts',
      'toType' => 'Post',
      'connectionTypeName' => 'RelatedPostsConnection',
      'connectionArgs' => [
        'limit' => [
          'name' => 'limit',
          'type' => 'Int',
          'description' => 'Override\'s YARPP setting\'s "Maximum number of related posts." The maximum number is 20.'
        ]
      ],
      'resolve' => function ($post, $args, $context, $info) {
        global $yarpp;
        $limit = isset($args['where']['limit']) ? $args['where']['limit'] : null;
        $related_posts = $yarpp->get_related($post->ID, $limit ? ['limit' => $limit] : null);
        $args['where']['in'] = array_map(function ($related_post) {
          return $related_post->ID;
        }, $related_posts);

        $resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver(null, $args, $context, $info, 'post');
        $result = $resolver->get_connection();
        return $result;
      }
    ]);
  }
});
