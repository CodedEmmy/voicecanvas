# VoiceCanvas - README

VoiceCanvas is an AI-based image generation tool that uses an audio description of the desired image to generate an image for the user

## Table of Contents

- [Setup](#setup)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Tech Stack](#tech-stack)
- [Future Updates](#future-updates)
- [License](#license)


## Setup

Follow these steps to set up the app on your server.

### Prerequisites

1. Web Server with support for PHP.
2. Web browser with support for web speech recognition API
3. Limewire API key for the image generator

### Installation

1. Clone or download the repository files:

2. Copy the repository files to your web server's http/web folder.

3. Configure the image API settings: open the config.php file in an editor and change the API_KEY paramater to match your Limewire API key.


## Usage

1. Open your web browser and navigate to the app's URL.

2. To generate an image, click on the "Create New" Button at the top-right of the home page. Using your connected microphone, give an audio description of the image you wish to generate. Click on the "Next" button and your image will be generated.


## Tech Stack

The app is built using a combination of different web technologies. These include:

- **PHP**
- **HTML**
- **Javascript**


## Future Updates

Features to be added in the future include
1. Configuration panel to allow the user to tweak the image parameters such as quality, style, etc.
2. Alternate input option for browsers that lack support for audio input.
3. Option to edit audio transcript before image generation.

## License

This project is licensed under the [GPL-3.0 License](LICENSE).

---
