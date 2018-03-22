!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

'Current Visitor' is defined as a visitor still inside the premises.

## Getting Visitors' Data

Visitor data can be retrieved using the `/v1/get/` endpoint.  

## Request

Supply a GET request the Authorization Header. If data for a specific visitor is required, also supply the corresponding Visitor ID.

### Retrieve all current visitors' data
```
GET  /v1/get/
Authorization: Token <access_token>
```  

### Retrieve data for a specific visitor
```
GET  /v1/get/<visitor-ID>
Authorization: Token <access_token>
```  

## Method URL
`/v1/get/` or `v1/get/<visitor-ID>`

## Required Parameters  
name | type | description
---- | ---- | -----------
visitor ID | string | Visitor ID of the visitor as specified above
**access_token** | string | The user's access token in the form of an Authorization header as specified above

## Response

The response generated will be in `JSON`.

### Sample Response
#### Request
```
GET  v1/get/ec2a335401e3d08e6ab5575aed394a971fe39d44
```
### Response
```json
{
    "success": true,
    "data": [
        {
            "visitor_id": "ec2a335401e3d08e6ab5575aed394a971fe39d44",
            "card_no": "42",
            "name": "Douglas Adams",
            "entry_time": "2017-07-13 15:54:05",
            "mobile": "4242424242",
            "purpose": "5"
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
visitor_id | string | Visitor ID of the entry
card_no | string | Card number of the visitor (1<cardno<10000)
name | string | Visitor name (length<50)
entry_time | string | Entry time of the visitor in `YYYY-MM-DD HH:ii:ss` format
mobile | string | Visitor's mobile number
purpose | integer | See below for valid values

### Bad Request
name | type | description
---- | ---- | -----------
success | boolean | false - for unsuccessful request
**errors** | **JSON Object** | **Contains error information which may include the following:**
3404 | string | Invalid visitor ID (APIMethodException)

Also may include general OAuth and Server errors as documented in [Errors and Exceptions](Errors-and-Exceptions.md).