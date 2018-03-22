!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

'Visitee' is defined as a person/employee whom the visitor intends to visit.

## Getting Visitees' Data

Visitor data can be retrieved using the `/v1/get/visitee/` endpoint.  

## Request

Supply a GET request with the Authorization Header.

### Retrieve all available visitees' data
```
GET  /v1/get/visitee/
Authorization: Token <access_token>
```  

## Method URL
`/v1/get/visitee/`

## Required Parameters  
name | type | description
---- | ---- | -----------
**access_token** | string | The user's access token in the form of an Authorization header as specified above

## Response

The response generated will be in `JSON`.

### Sample Response
#### Request
```
GET  v1/get/visitee
```
### Response
```json
{
    "success": true,
    "data": [
        {
            "visitee_no": "1",
            "name": "John Reese"
        },
        {
            "visitee_no": "2",
            "name": "Harold Swift"
        }
    ]
}
```

## Response Parameters
### Successful Request
name | type | description
---- | ---- | -----------
success | boolean | true - for successful request
data | JSON Array | JSON Array consisting of multiple entries with every entry having:
visitee_no | integer | Visitee ID of the employee
name | string | Visitee name

### Bad Request
name | type | description
---- | ---- | -----------
success | boolean | false - for unsuccessful request
**errors** | **JSON Object** | **Contains error information (see error documentation)**

Includes general OAuth and Server errors as documented in [Errors and Exceptions](Errors-and-Exceptions.md).