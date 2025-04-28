# GSAP Animations

## Overview
This theme comes with built-in GSAP animations, making it easy to add smooth and engaging animations to your content.

## Available Animations
You can apply animations to any element by simply adding the following classes to the element:

- `.fade-in` – fades in the element
- `.fade-left` – fades in the element from the left
- `.fade-right` – fades in the element from the right
- `.fade-out` – fades out the element
- `.text-reveal` – reveals the text
- `.scroll-left` – scrolls the element from the left
- `.scroll-right` – scrolls the element from the right
- `.fade-batch` – applies batch animations

## Additional Options
You can also customize the animations with data attributes:

- `data-delay="0.5"` – Adds a delay before the animation starts (in seconds)
- `data-ease="power3.out"` – Defines the easing curve for the animation

## Example Usage
Simply add the appropriate class to your HTML element, and GSAP will handle the animation when the element comes into view or reaches a certain point in the viewport.

Example HTML:
```html
<div class="fade-in" data-delay="0.3" data-ease="ease-out">Content</div>
```



# Fitty.js

## Overview
Fitty.js is a lightweight JavaScript library that automatically resizes text to fit within its container. It helps ensure that your text always looks great, regardless of screen size or container dimensions.

## How to Use
To use Fitty.js, simply add the class `fitty-text` to any text element you want to resize.

### Example Usage:

1. Add the `fitty-text` class to your text element:
   ```html
   <h1 class="fitty-text">This is a heading</h1>
    ```

