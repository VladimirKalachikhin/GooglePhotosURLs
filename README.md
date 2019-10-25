# GooglePhotosURLs  
PHP function to create list of GooglePhotos from the GooglePhotos public album url.  
And PHP function to create embedded code for one GooglePhoto.

## Features
* Original, preview or any size of images (by GooglePhoto engine)
* `<img ...>` or url only output
* `<a ...><img ...></a>` embedded code or url only output for one GooglePhoto

## Example
See `index.php`

## Usage
One GooglePhoto:  
`$ php GooglePhotoURLcli.php https://https://photos.app.goo.gl/yougooglephotosharedlinknumber`  
GoogleAlbum:  
`php GooglePhotosURLscli.php https://https://photos.app.goo.gl/yougooglephotoalbumsharedlinknumber` 

## Restrictions
The image url must be on a separate string in source of album’s web page. Now it is.

## To create a public GooglePhotos url:
- GoTo you GooglePhotos album or click to the GooglePhoto
- Click the **Share** icon
- Click **Get link**