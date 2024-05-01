#include <iostream>

using namespace std;

int main()
{
    const double pi = 3.14159265358979323846;
    int n;
    float ex;
    cin>>n;
    int* x = new int[n];
    for(int i=0;i<n;i++)
    {
        cin>>x[i];
        ex =x[i];
        if (ex<=1000)
        {
           x[i]= 2*ex*2*ex-2*pi*ex*ex;
        }
    }
    for (int i = 0; i < n; i++)
    {
        cout<<x[i]<<endl;
    }

}