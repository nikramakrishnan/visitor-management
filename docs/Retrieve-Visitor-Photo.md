!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

A visitor photo is an image of a person visiting someone or somewhere, that is added when a visitor enters the premises.

## Get Visitor Photo

A visitor photo can be retrieved using the `/v1/photo/` or `v1/photo/thumb/` endpoints, for photos and thumbnails respectively.  

## Request

Supply a GET request with the visitor ID and Authorization Header.
### Full Photo
```
GET  /v1/photo/<visitor-ID>
Authorization: Token <access_token>
```  
### Thumbnail
```
GET  /v1/photo/thumb/<visitor-ID>
Authorization: Token <access_token>
``` 

## Method URL
`/v1/photo/` and `v1/photo/thumb/`

## Required Parameters  
name | type | description
---- | ---- | -----------
visitor ID | string | Visitor ID of the visitor as specified above
**access_token** | string | The user's access token in the form of an Authorization header as specified above

Some caveats:

* If an invalid Visitor ID is provided, the page will return a JSON Response instead of an image file. See below for more details.

## Response

If visitor ID and Access Token is valid, an image file (in one of the supported formats) is generated on the page. If any one is invalid, then a `JSON` Response with the corresponding error code is generated.  

!!! note
    Thumbnails are always returned in `.jpg` format.

## Response Parameters
### Successful Request
None. Image file is generated and displayed on the page.

### Bad Request
name | type | description
---- | ---- | -----------
success | boolean | false - for unsuccessful request
**errors** | **JSON Object** | **Contains error information which may include the following:**
3404 | string | Invalid visitor ID (APIMethodException)
4515 | string | Image not available (RequestedObjectException 4515)

Also may include general OAuth and Server errors as documented in [Errors and Exceptions](Errors-and-Exceptions.md).

## Best Practices

* **Use thumbnails**: Use thumbnails to reduce cost, and increase speed when displaying image previews. Load full images only when required.