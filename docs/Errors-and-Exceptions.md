!!! warning
    This API is still under development and may undergo major changes without change in version number. This documentation may become **incomplete** or **incorrect** at any time, until this notice is removed.  

## List of Exceptions, Types and Error Codes 

This is a list of currently available Error codes and types. This can be used as a reference to fix problems with OAuth and API Requests. It also contains a description of server side errors.

## Error Format

Errors codes and types are sent as a part of the `errors` JSON Object. The following is an example of an error, where a `GET` request does not provide Authorization Header:

```json
{
    "success": false,
    "errors": {
        "message": "An active access token must be used to query information about the current visitors.",
        "type": "OAuthException",
        "code": "1190"
    }
}
```
All errors comprise of three parts:
* message: Human-readable error message.
* type: Error type (See below for available types).
* code: Error codes for that error (See below for available error codes).

Check the respective API page for endpoint-specific errors.

### OAuthException - 1xxx

Code| Name | Description
---- | ---- | -----------
1142 | Wrong Credentials | Credentials provided are wrong
1157 | Auth Data Missing | Required authentication data not provided
1190 | Access Token Missing | Access Token not provided as Authorization header or access token not provided in correct format in header
1403 | API Session | This means that the login status or access token has expired, been revoked, or is otherwise invalid

### APIMethodException - 2xxx/3xxx

Code| Name | Description
---- | ---- | -----------
2200 | Data Not Supplied | Required POST data was not provided
2400 | Incorrect Data Format | Incorrect data format/Data is too large
23xx | /add/ Endpoint Errors  |Specific errors for /v1/add/ endpoint ([[Ref\|API:-Adding-a-Visitor#bad-request]])
2415 | Unsupported Media Format | Unsupported media type
2600 | Unknown Path Components | The API Endpoint does not exist or the URL parameters include unrecognized paths
3100 | GET Data Not Supplied | Required get data not provided
3404 | Object Not Found | Object does not exist

### RequestedObjectException - 4xxx

Code| Name | Description
---- | ---- | -----------
4515 | Resource Unavailable | Requested resource is not available/generated

### ServerSideException - 5xxx

Code| Name | Description
---- | ---- | -----------
5501 | Server Issue | Temporary issue due to downtime or throttling. Wait and retry the operation.
