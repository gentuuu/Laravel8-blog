<?php

// blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->push('Blog', route('blog.home'));
});

Breadcrumbs::for('blog_home', function ($trail) {
    $trail->parent('blog');
    $trail->push('Home', route('blog.home'));
});

Breadcrumbs::for('blog_categories', function ($trail) {
    $trail->parent('blog');
    $trail->push('Categories', route('blog.categories'));
});


// admin
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

Breadcrumbs::for('dashboard_home', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '#');
});

Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('categories.index'));
});

Breadcrumbs::for('add_category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Add', route('categories.create'));
});

Breadcrumbs::for('edit_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Edit', route('categories.edit', ['category' => $category]));
});

Breadcrumbs::for('edit_category_title', function ($trail, $category) {
    $trail->parent('edit_category',  $category);
    $trail->push($category->title, route('categories.edit', ['category' => $category]));
});

Breadcrumbs::for('detail_category', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Detail', route('categories.show', ['category' => $category]));
});

Breadcrumbs::for('detail_category_title', function ($trail, $category) {
    $trail->parent('detail_category',  $category);
    $trail->push($category->title, route('categories.show', ['category' => $category]));
});

Breadcrumbs::for('tags', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags', route('tags.index'));
});

Breadcrumbs::for('add_tags', function ($trail) {
    $trail->parent('tags');
    $trail->push('Add', route('tags.create'));
});

Breadcrumbs::for('edit_tags', function ($trail, $tag) {
    $trail->parent('tags');
    $trail->push('Edit', route('tags.edit',['tag'=>$tag]));
    $trail->push($tag->title, route('tags.edit',['tag'=>$tag]));
});

Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('posts.index'));
});

Breadcrumbs::for('add_post', function ($trail) {
    $trail->parent('posts');
    $trail->push('Add', route('posts.create'));
});

Breadcrumbs::for('detail_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Detail', route('posts.show', ['post' => $post]));
    $trail->push($post->title, route('posts.show', ['post' => $post]));
});

Breadcrumbs::for('edit_post', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Edit', route('posts.edit', ['post' => $post]));
    $trail->push($post->title, route('posts.edit', ['post' => $post]));
});

Breadcrumbs::for('file_manager', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('File manager', route('filemanager.index'));
});

Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('roles');
    $trail->push('Add', route('roles.create'));
});


Breadcrumbs::for('detail_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push('Detail', route('roles.show', ['role' => $role]));
    $trail->push($role->name, route('roles.show', ['role' => $role]));
});

Breadcrumbs::for('edit_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push('Edit', route('roles.edit', ['role' => $role]));
    $trail->push($role->name, route('roles.edit', ['role' => $role]));
});


Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('User', route('users.index'));
});

Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('users');
    $trail->push('Add', route('users.create'));
});

Breadcrumbs::for('edit_user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Edit', route('users.edit', ['user' => $user]));
    $trail->push($user->name, route('users.edit', ['user' => $user]));
});









// // Home > About
// Breadcrumbs::for('about', function ($trail) {
//     $trail->parent('home');
//     $trail->push('About', route('about'));
// });

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });

?>