# GooglePhotosURLs  
A PHP function and cli tool to takes the permanent url and create list of GooglePhotos from the GooglePhotos public album url.  
And PHP function and cli tool to create embedding code with permanent url for one GooglePhoto.  
## v.1.0
New API, not compatible with previous.
## Features
* Original, preview or any size of images (by GooglePhoto engine)
* Original filename
* URL only or csv-style `"original_file_name","permanent_url"` output for album
* `<a ...><img ...></a>` embedded code or url only output for one GooglePhoto

## Example
See `index.php`

## Usage cli
`$ ./GooglePhotoURLcli.php --help`
### One GooglePhoto  
Embedding code with GooglePhoto preview-size image and with link to original size:  
`$ ./GooglePhotoURLcli.php https://https://photos.app.goo.gl/YouGooglePhotoSharedLinkNumber`  

Embedding code with preview 100x60 size image and with link to original size:  
`$ ./GooglePhotoURLcli.php https://https://photos.app.goo.gl/YouGooglePhotoSharedLinkNumber 100 60`  

URL of original size image:  
`$ ./GooglePhotoURLcli.php -m https://https://photos.app.goo.gl/YouGooglePhotoSharedLinkNumber `  

URL of 800x600 size image:  
`$ ./GooglePhotoURLcli.php https://https://photos.app.goo.gl/YouGooglePhotoSharedLinkNumber 800 600 1`  

Original file name and url of original size image:  
`$ ./GooglePhotoURLcli.php -m=csv https://https://photos.app.goo.gl/YouGooglePhotoSharedLinkNumber `  

### GoogleAlbum:  
List of embedding codes of all album images with GooglePhoto preview-size image and with link to original size:  
`$ php GooglePhotosURLscli.php https://https://photos.app.goo.gl/YouGooglePhotoAlbumSharedLinkNumber`  

List of embedding codes of all album images with GooglePhoto preview-size image and with **link to 800x600 size**:  
`$ php GooglePhotosURLscli.php https://https://photos.app.goo.gl/YouGooglePhotoAlbumSharedLinkNumber 800 600`  

List of original file names and urls of original size images:
`$ php GooglePhotosURLscli.php -m=csv https://https://photos.app.goo.gl/YouGooglePhotoAlbumSharedLinkNumber`  

List of original file names and **urls of 800x600 size images**:
`$ php GooglePhotosURLscli.php https://https://photos.app.goo.gl/YouGooglePhotoAlbumSharedLinkNumber 800 600 csv`  

## Restrictions
The image url must be on a separate string in source of album’s or one image web page. Now it is.

## To create a public GooglePhotos url:
- GoTo you GooglePhotos album or click to the GooglePhoto
- Click the **Share** icon
- Click **Get link**