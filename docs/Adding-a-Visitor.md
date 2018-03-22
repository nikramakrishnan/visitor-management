!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

A visitor entry is a record of a person visiting someone or somewhere.

## Adding a Visitor Entry

A visitor entry can be added using the `/v1/add/` endpoint.  

## Request

The request should be POST with `multipart/form-data` encoding. ([Reference for Android](https://stackoverflow.com/a/7645328/2068807)).
```
POST /v1/add/
     ?cardno={card-number}
     &name={visitor-name}
     &mobile={mobile-number}
     &purpose={value}
     &image={image-data}
     &access_token={token}
     [&debug={value}]
```  

## Method URL
`/v1/add/` 

!!! note
    Due to the how XAMPP Apache is configured, `POST` requests will be discarded if the trailing slash (`/`) is not added in the end of the URL. Please make sure to either use a trailing slash, or supply the request to `/v1/add/index.php`

## Required Parameters  
name | type | description
---- | ---- | -----------
cardno | string | Card number of the visitor (1<cardno<10000)
name | string | Visitor name (length<50)
mobile | string | Visitor mobile number (5<length<11)
purpose | integer | See below for valid values
image | multipart/form-data | Image file (see below for accepted formats)
**access_token** | string | The user's access token
 
### Purpose
The purpose is a string (max. length = 50). It should ideally be short and precise, such as 'Delivery', or 'Meeting' etc.

### Image
The image must be sent as a `multipart/form-data` with correct request headers.  
Supported Formats:  

- JPEG
- PNG
- BMP


!!! tip "Some caveats"
    - If you upload a PNG file, try keep the file size below 1 MB. PNG files larger than 1 MB may appear pixelated after upload.
    - Check the file size of your photos. We recommend uploading photos under 4MB.

## Optional Parameters  
name | type | description
---- | ---- | -----------
visitee_no | int | See below for valid values
debug | int | See below for valid values

### visitee_no
The id of the visitee (person to visit), retrieved from `/get/visitee/` endpoint.

### debug

!!!note
    Will be only available in `Development` branch.  

- 0 = Disable debug mode (default)
- 1 = Enable debug mode

## Response

The response generated will be in `JSON`.

### Sample Response
```json
{
  "success": true,
  "visitor_id": "65034595a070faf841654619627"
}
```

## Response Parameters
### Successful Request
name | type | description
---- | ---- | -----------
success | boolean | true - for successful request
visitor_id | string | Unique ID for the visitor entry

### Bad Request
Code | Name | Description
---- | ---- | -----------
success | boolean | false - for unsuccessful request
**errors** | **JSON Object** | **Contains error information which may include the following:**
2301 | Incorrect format | Incorrect format for card number (see above for accepted formats)
2302 | Incorrect format | Incorrect format for mobile number (see above for accepted formats)
2303 | Incorrect format | Incorrect purpose data supplied (see above for accepted formats)
2415 | Incorrect image extension | Image file with correct extension not supplied (see above for accepted extensions)

Also may include general OAuth and Server errors as documented in [Errors and Exceptions](Errors-and-Exceptions.md).

### Debug Mode Enabled
name | type | description
---- | ---- | -----------
**debug** | **JSON Object** | **Contains debugging data which may include the following:**
mysql | string | Returns the MYSQL error when query fails
upload | string | Problems with uploading photo (server-side)

!!! note
    Returned only with debug mode enabled.

## Best Practices

* **Photo**: It is recommended that the photo is uploaded with the following specifications:
   * Format: JPEG/PNG
   * Size: Not more than 1MB (apply required lossless/lossy compression client-side)
   * Make sure the loss in quality (in case of lossy compression) does not make the image too pixelated to be viewed on a computer screen.