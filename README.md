# PHP Image Viewer

A simple image gallery built with PHP that reads images from a folder and displays them. This project features image zooming, keyboard navigation with left and right arrow keys, and a dark theme.

## Features

- **Automatic Image Folder Detection**: The project automatically finds the folder containing images and displays its name as the title.
- **Gallery Display**: Images are displayed in a responsive grid.
- **Zooming**: Clicking on any image card opens it in a modal for zooming.
- **Keyboard Navigation**: In zoom mode, use left (←) and right (→) arrow keys to navigate between images. Press Escape to close the modal.
- **Dark Theme**: Dark background for a better experience.
- **Image Information**: Displays file name, modification date, and file size.
- **Sorting**: Images are sorted by newest date first.

## Technologies Used

- **PHP**: For server-side processing and file reading.
- **HTML/CSS**: For structure and styling.
- **JavaScript**: For client-side interactions like modal and keyboard navigation.

## Installation and Running

1. **Clone the Repository**:

   ```
   git clone https://github.com/moghadam-pro/php-file-reader.git
   cd php-file-reader
   ```

2. **Add Images**:

   - Create a folder in the project directory (e.g., `images`).
   - Place images in allowed formats (jpg, jpeg, png, gif, webp) in this folder.

3. **Run the Server**:
   - Use a local server like XAMPP, WAMP, or PHP built-in server.
   - For PHP built-in server:
     ```
     php -S localhost:8000
     ```
   - Then open `http://localhost:8000` in your browser.

## File Structure

- `index.php`: Main PHP file that generates the gallery.
- `script.js`: JavaScript for modal and keyboard interactions.
- `style.css`: CSS styles for dark theme and responsive design.
- `README.md`: This file.

## How It Works

- The project scans the directory and finds the first folder containing images.
- Images are sorted by date.
- On the page, image cards are displayed; clicking them opens the modal.
- In the modal, you can navigate with left and right arrow keys.

## Contributing

If you want to contribute, please open an issue or send a pull request.

## License

This project is under the MIT License.</content>
<parameter name="filePath">c:\dev\php-file-reader\README.md
